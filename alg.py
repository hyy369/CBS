import psycopg2
import getpass
import sys

mondays=['1-23','1-30','2-6','2-13','2-20','2-27','3-6','3-13','3-20','3-27','4-3','4-10','4-17','4-24']
tuesdays=['1-24', '1-31', '2-7', '2-14', '2-21', '2-28', '3-7', '3-14', '3-21', '3-28', '4-4', '4-11', '4-18', '4-25']
wednesdays=['1-18','1-25','2-1','2-8','2-15','2-22','3-1','3-8','3-15','3-22','3-29','4-5','4-12','4-19','4-26']
thursdays=['1-19','1-26','2-2','2-9','2-16','2-23','3-2','3-9','3-16','3-23','3-30','4-6','4-13','4-20','4-27',]
fridays=['1-20','1-27','2-3','2-10','2-17','2-24','3-3','3-10','3-17','3-24','3-31','4-7','4-14','4-21','4-28']

def request_from_db(request_str):
    try:
        connection = psycopg2.connect( database = "swyao_CBS", user = "nswhay", password = "nswhay", host='db.cs.wm.edu')
    except StandardError, e:
        print(str(e))
        exit

    cur = connection.cursor()
    try:
        cur.execute(request_str)
    except StandardError, e:
        print(str(e))

    arr = cur.fetchall()

    cur.close()
    connection.close()
    return arr

def input_to_db(request_str):
    try:
        connection = psycopg2.connect( database = "swyao_CBS", user = "nswhay", password = "nswhay", host='db.cs.wm.edu')
    except StandardError, e:
        print(str(e))
        exit

    cur = connection.cursor()
    try:
        cur.execute(request_str)
    except StandardError, e:
        print(str(e))

    connection.commit()

    cur.close()
    connection.close()
    return

def unique_room_request(crn, room, timeslots, weekday, req_list, write_file):

    for req in req_list:
        if crn == req[0]:

            write_file.write(crn + " " + room + " " + str(timeslots) + "\n")
            request = "insert into eventCopy values(" + crn + ", 0, 'class');"

            input_to_db(request)

            if weekday == "MWF":
                for i in mondays:
                    date = '2017-0' + i
                    for time in timeslots:
                        update = "update timesCopy set event_id=" + crn + " where room_id='" + room + "' and date='" + date + "' and time ='" + time + "';"
                        input_to_db(update)
                for i in wednesdays:
                    date = '2017-0' + i
                    for time in timeslots:
                        update = "update timesCopy set event_id=" + crn + " where room_id='" + room + "' and date='" + date + "' and time ='" + time + "';"
                        input_to_db(update)
                for i in fridays:
                    date = '2017-0' + i
                    for time in timeslots:
                        update = "update timesCopy set event_id=" + crn + " where room_id='" + room + "' and date='" + date + "' and time ='" + time + "';"
                        input_to_db(update)
            if weekday == "TR":
                for i in tuesdays:
                    date = '2017-0' + i
                    for time in timeslots:
                        update = "update timesCopy set event_id=" + crn + " where room_id='" + room + "' and date='" + date + "' and time ='" + time + "';"
                        input_to_db(update)
                for i in thursdays:
                    date = '2017-0' + i
                    for time in timeslots:
                        update = "update timesCopy set event_id=" + crn + " where room_id='" + room + "' and date='" + date + "' and time ='" + time + "';"
                        input_to_db(update)
            req_list.remove(req)
            break
    return req_list

def float_to_time(number):
    hour = int(number)
    minute_str = ""
    if number > hour:
        minute_str = "30"
    else:
        minute_str = "00"

    if (hour == 8 or hour == 9):
        hour_str = "0" + str(hour)
    else:
        hour_str = str(hour)

    return hour_str + ":" + minute_str

def create_timeslots(start_time, duration):
    end = start_time + duration

    i = start_time
    arr = []
    while (i < end):
        arr.append(float_to_time(i))
        i += 0.5

    #print(arr)
    return arr

def build_where_string(position_list, value_list):
    listkey = ["building=", "room_number=", "capacity>=", "projector=", "visualizer=", "(whiteboard=", "outlets>="]
    str_return = "where "

    total_length = len(position_list)
    if total_length == 0:
        return ""

    for i in range(0, total_length - 1):
        str_return += listkey[position_list[i]] + str(value_list[i]) + " and "

    str_return += listkey[position_list[total_length - 1]] + value_list[total_length - 1] + ";"

    return str_return

    # building = req[1] #value is string
    # room_number = req[2] #value is string
    # capacity = int(req[6]) # field is 'capacity'; value is an integer
    # projector = req[7] # field is 'projector'; value is 'YES' in database
    # visualizer = req[8] # field is 'visualizer'; value is 'YES' or 'NO' in database
    # board = req[9] # field is 'whiteboard'; value is 'CHALKBOARD' or 'WHITEBOARD' or 'BOTH'
    # outlets = req[10] # field is 'outlets'; value is an integer

def make_query_string(req):
    # crn, building, room_num, start time, duration, weekdays, capacity, projector, visualizer, board type, outlets
    # ['25639', 'ISC', 'NULL', 13.0, 1.0, 'MWF', '26', '0', '1', '0', '3']
    building = req[1]  # value is string
    room_number = req[2]  # value is string
    capacity = int(req[6])  # field is 'capacity'; value is an integer
    projector = req[7]  # field is 'projector'; value is 'YES' in database
    visualizer = req[8]  # field is 'visualizer'; value is 'YES' or 'NO' in database
    board = req[9]  # field is 'whiteboard'; value is 'CHALKBOARD' or 'WHITEBOARD' or 'BOTH'
    outlets = req[10]  # field is 'outlets'; value is an integer

    position_list = []
    value_list = []
    if building != "NULL":
        position_list.append(0)
        value_list.append("\'" + building + "\'")
    if room_number != "NULL":
        position_list.append(1)
        value_list.append("\'" + room_number + "\'")
    if capacity != "NULL":
        position_list.append(2)
        value_list.append(int(capacity))
    if projector != "NULL":
        position_list.append(3)
        if int(projector) == 0:
            value_list.append("'NO'")
        else:
            value_list.append("'YES'")
    if visualizer != "NULL":
        position_list.append(4)
        if int(visualizer) == 0:
            value_list.append("'NO'")
        else:
            value_list.append("'YES'")
    if board != "NULL":
        position_list.append(5)
        if int(board) == 0:
            value_list.append("'CHALKBOARD' or whiteboard='BOTH')")
        else:
            value_list.append("'WHITEBOARD' or whiteboard='BOTH')")
    if outlets != "NULL":
        position_list.append(6)
        value_list.append(outlets)

    query = "select * from rooms " + build_where_string(position_list, value_list)

    return  query

def decrement_restrictions(req):
    building = req[1]  # value is string
    room_number = req[2]  # value is string
    capacity = req[6]  # field is 'capacity'; value is an integer
    projector = req[7]  # field is 'projector'; value is 'YES' in database
    visualizer = req[8]  # field is 'visualizer'; value is 'YES' or 'NO' in database
    board = req[9]  # field is 'whiteboard'; value is 'CHALKBOARD' or 'WHITEBOARD' or 'BOTH'
    outlets = req[10]  # field is 'outlets'; value is an integer

    if outlets != "NULL":
        req[10] = "NULL"
        return req
    if room_number != "NULL":
        req[2] = "NULL"
        return req
    if building != "NULL":
        req[1] = "NULL"
        return req
    if board != "NULL":
        req[9] = "NULL"
        return req
    if visualizer != "NULL":
        req[8] = "NULL"
        return req
    if projector != "NULL":
        req[7] = "NULL"
        return req
    if capacity != "NULL":
        req[6] = "NULL"
        return req

#-------------------------------------------------------------------------------------------------------------------

room_requests = {}
all_requests = []
fr = open("input.txt", "r")
for request in fr:
    request = request.strip()
    request = request.split(',')
    request[3] = float(request[3])
    request[4] = float(request[4])
    all_requests.append(request)

    # crn, building, room_num, start time, duration, weekdays, capacity, projector, visualizer, board type, outlets
    if request[1] != "NULL" and request[2] != "NULL":
        specific_room = request[1] + " " + request[2]
        new_request = [request[0], request[3], request[4], request[5]]
        if specific_room in room_requests:
            room_requests[specific_room].append(new_request)
        else:
            room_requests[specific_room] = [new_request]

fr.close



print("ALL REQUESTS:")
for thing in all_requests:
    print(thing)



fw = open("output.txt", "w")
for room_id, value in room_requests.items():
    # value = crn, start, duration, weekday
    if len(value) == 1:
        crn = value[0][0]
        weekday = value[0][3]
        timeslot = create_timeslots(value[0][1], value[0][2])
        unique_room_request(crn, room_id, timeslot, weekday, all_requests, fw)
    else:
        mwf_list = []
        tth_list = []
        for request in value:
            if request[3] == "MWF":
                mwf_list.append(request)
            if request[3] == "TR":
                tth_list.append(request)

        if len(mwf_list) == 1:
            crn = mwf_list[0][0]
            weekday = mwf_list[0][3]
            timeslot = create_timeslots(mwf_list[0][1], mwf_list[0][2])
            unique_room_request(crn, room_id, timeslot, weekday, all_requests, fw)
        elif len(mwf_list) > 1:
            sorted(mwf_list, key = lambda x: x[1])

            i = 0
            a = 1
            while(i + 1 < len(mwf_list)):
                cur_req = mwf_list[i]
                cur_endtime = cur_req[1] + cur_req[2]
                next_req = mwf_list[i + a]
                next_starttime = next_req[1]

                while (next_starttime <= cur_endtime and a < len(mwf_list) - 1 - i):
                    a+=1
                    next_req = mwf_list[i + a]
                    next_starttime = next_req[1]

                if a == len(mwf_list) - 1 - i: # reached end of list
                    if next_starttime > cur_endtime:

                        crn_next = next_req[0]
                        weekday_next = next_req[3]
                        timeslot_next = create_timeslots(next_req[1], next_req[2])
                        unique_room_request(crn_next, room_id, timeslot_next, weekday_next, all_requests, fw)

                crn = cur_req[0]
                weekday = cur_req[3]
                timeslot = create_timeslots(cur_req[1], cur_req[2])
                unique_room_request(crn, room_id, timeslot, weekday, all_requests, fw)

                i = i + a
                a = 1


        if len(tth_list) == 1:
            crn = tth_list[0][0]
            weekday = tth_list[0][3]
            timeslot = create_timeslots(tth_list[0][1], tth_list[0][2])
            unique_room_request(crn, room_id, timeslot, weekday, all_requests, fw)
        elif len(tth_list) > 1:
            sorted(tth_list, key = lambda x: x[1])

            i = 0
            a = 1
            while(i + 1 < len(tth_list)):
                cur_req = tth_list[i]
                cur_endtime = cur_req[1] + cur_req[2]
                next_req = tth_list[i + a]
                next_starttime = next_req[1]

                while (next_starttime <= cur_endtime and a < len(tth_list) - 1 - i):
                    a+=1
                    next_req = tth_list[i + a]
                    next_starttime = next_req[1]

                if a == len(tth_list) - 1 - i: # reached end of list
                    if next_starttime > cur_endtime:

                        crn_next = next_req[0]
                        weekday_next = next_req[3]
                        timeslot_next = create_timeslots(next_req[1], next_req[2])
                        unique_room_request(crn_next, room_id, timeslot_next, weekday_next, all_requests, fw)

                crn = cur_req[0]
                weekday = cur_req[3]
                timeslot = create_timeslots(cur_req[1], cur_req[2])
                unique_room_request(crn, room_id, timeslot, weekday, all_requests, fw)

                i = i + a
                a = 1

for req in all_requests:

    query = make_query_string(req)
    print("QUERY IS: " + query)
    tups = request_from_db(query)

    found_placement_flag = 0

    while (found_placement_flag == 0):

        while (len(tups) == 0):
            req = decrement_restrictions(req)
            print(req)
            query = make_query_string(req)
            tups = request_from_db(query)

        for tup in tups:
            # ('MORTON 1', 'MORTON', '1', 'YES', 'CHALKBOARD', 'YES', 10, 40)
            timeslots = create_timeslots(req[3], req[4])
            check_array = []
            if req[5] == "MWF":
                date = '2017-0' + mondays[0]
                for time in timeslots:
                    check_str = "select * from timesCopy where room_id='" + tup[0] + "' and date='" + date + "' and time ='" + time + "' and event_id is null;"
                    check_array.append(len(request_from_db(check_str)))
            else:
                date = '2017-0' + tuesdays[0]
                for time in timeslots:
                    check_str = "select * from timesCopy where room_id='" + tup[0] + "' and date='" + date + "' and time ='" + time + "' and event_id is null;"
                    check_array.append(len(request_from_db(check_str)))

            if sum(check_array) == len(timeslots):
                crn = req[0]
                weekday = req[5]
                room_id = tup[0]
                unique_room_request(crn, room_id, timeslots, weekday, all_requests, fw)
                found_placement_flag = 1
                break

        if found_placement_flag == 0:
            tups = []

fw.close()

print("ALL REQUESTS:")
for thing in all_requests:
    print(thing)
print("ROOM_REQUESTS:")
print(room_requests)

    

