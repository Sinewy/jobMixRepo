#!/usr/bin/env python


import serial
import time
import sys


DEVICE = '/dev/ttyAMA0'
BAUDRATE = 9600
TIMEOUT = 3.

def connect(device=DEVICE, baudrate=BAUDRATE, timeout=TIMEOUT):
    p = serial.Serial(device, baudrate=baudrate, timeout=timeout)
    return p


def sendln(port, text):
    port.write(text + '\r\n')


def recvln(port):
    r = []
    while True:
        c = port.read(1)
        if c == '':
            break
        if c == '\n':
            break
        if c == '\r':
            continue
        r.append(c)
    return ''.join(r)


# protocol
#


def do_command(port, cmdln):
    sendln(port, cmdln)
    res = []
    # expect echo
    r = recvln(port)
    if r == '':
        return False, 'no response'
    while r != 'PB_OK':
        if r != '':
            res.append(r)
        else:
            # TODO timeout
            pass
        r = recvln(port)
    return True, res


def do_table_init(port):
    ok, res = do_command(port, 'TABLE INIT')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_table_position(port, position):
    ok, res = do_command(port, 'TABLE POSITION %d' % position)
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_valve_init(port):
    ok, res = do_command(port, 'VALVE INIT')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_pump_init(port):
    ok, res = do_command(port, 'PUMP INIT')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_init(port):
    ok, res = do_command(port, 'INIT')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_pump_up(port, steps, speed):
    ok, res = do_command(port, 'PUMP UP %s %s' % (steps, speed))
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_pump_down(port, steps, speed):
    ok, res = do_command(port, 'PUMP DOWN %s %s' % (steps, speed))
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_valve_close(port):
    ok, res = do_command(port, 'VALVE CLOSE')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_valve_open_fine(port):
    ok, res = do_command(port, 'VALVE OPEN FINE')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


def do_valve_open_coarse(port):
    ok, res = do_command(port, 'VALVE OPEN COARSE')
    if ok:
        # TODO parse replies
        return True, res
    return ok, res


#
#
def do_login(port):
    # check
    sendln(port, '1')
    res = recvln(port)  # < '1'
    if res != '':
        recvln(port)    # < 'Unknown Command/Parameter "1"'
        recvln(port)    # < 'PB_OK'
        return True
    # or try
    sendln(port, '1')
    time.sleep(0.5)
    sendln(port, '2')
    time.sleep(0.5)
    sendln(port, '3')
    time.sleep(0.5)
    res = recvln(port)
    if res != '':
        return True
    return False


def do_check_init(port):
    ok, res = do_command(port, 'POSITIONS')
    if not ok:
        return False
    if len(res) != 2 or res[1] == 'Table not initialized':
        return False
    return True


#
#
def do_one(port, position, pump_up, pump_down, pump_speed):
    # TODO errors
    do_pump_init(port)
    do_table_position(port, position)
    do_valve_open_coarse(port)
    do_pump_up(port, pump_up, pump_speed)
    do_pump_down(port, pump_down, pump_speed)
    do_valve_close(port)


def do_many(port, many):
    # TODO errors
    for position, pump_up, pump_down, pump_speed in many:
        do_one(port, position, pump_up, pump_down, pump_speed)


TEST_MANY = [
    (3, 5000, 1000, 100),
    #(4, 500, 200, 50),
    (7, 1000, 100, 50),
    (12, 3000, 1000, 70),
    #(14, 2000, 500, 50),
]


# run test
if __name__ == '__main__':
    port = connect()
    # try to login
    if not do_login(port):
        print 'error: login'
        sys.exit(-1)
    # check if initialized
    if not do_check_init(port):
        do_init(port)
    # do stuff
    do_many(port, TEST_MANY)
    sys.exit(0)


