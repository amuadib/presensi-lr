import sys
import face_recognition as fr
import os
import pickle

# USAGE
# python face.py  <mode : encode|match> <path_to_image_file> <path_to_pickle_file>
# Return Value
# 99: success
# <top, left, bottom, right>: Face Location, only in <match> mode
# 0: General Error
# 1: .pickle file not found
# 2: Face location not found
# 3: Cannot get face Encodings
# 4: File not found
# 5: Invalid Command

# FILE
# try:
#     norm_path = os.path.normpath(sys.argv[2])
# except:
#     print(4)
#     quit()

# split_path = os.path.split(norm_path)
# file_name = os.path.splitext(os.path.basename(split_path[1]))[0]

# MODE
if sys.argv[1] == 'encode':
    file = fr.load_image_file(os.path.normpath(sys.argv[2]))
    try:
        encoding = fr.face_encodings(file)[0]
        f = open(os.path.normpath(sys.argv[3]), "wb")
        f.write(pickle.dumps(encoding))
        f.close
        print(99)
    except:
        print(0)

elif sys.argv[1] == 'match':
    try:
        known_encodings = [pickle.loads(
            open(os.path.normpath(sys.argv[3]), "rb").read())]  # Array
    except:
        print(1)
        quit()

    file = fr.load_image_file(os.path.normpath(sys.argv[2]))

    try:
        locations = fr.face_locations(file)
    except:
        print(2)
        quit()

    try:
        encoding = fr.face_encodings(file, locations)[0]
    except:
        print(3)
        quit()

    match = fr.compare_faces(known_encodings, encoding, 0.4)
    try:
        loc = ','.join(str(e) for e in locations[0])
        if match[0] == True:
            print(loc)
        else:
            print(0)
    except:
        print(0)
else:
    print(5)
