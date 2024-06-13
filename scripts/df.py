from deepface import DeepFace
import sys
import os

# USAGE
# python deepface.py  <mode : analyze|verify> <img1_path> <img2_path>

action_list = ['age', 'gender', 'race', 'emotion']
metrics = ["cosine", "euclidean", "euclidean_l2"]
backends = [
    'opencv',
    'ssd',
    'dlib',
    'mtcnn',
    'retinaface',
    'mediapipe'
]
# MODE
if sys.argv[1] == 'analyze':
    try:
        objs = DeepFace.analyze(
            img_path=os.path.normpath(sys.argv[2]),
            actions=['age']
        )
        print(objs)
    except:
        print(0)

elif sys.argv[1] == 'verify':
    try:
        result = DeepFace.verify(
            img1_path=os.path.normpath(sys.argv[2]),
            img2_path=os.path.normpath(sys.argv[3]),
            distance_metric=metrics[2],
            detector_backend=backends[0]
        )
        if result['verified'] == True:
            x1 = int(result['facial_areas']['img2']['x']) + \
                int(result['facial_areas']['img2']['w'])
            y2 = int(result['facial_areas']['img2']['y']) + \
                int(result['facial_areas']['img2']['h'])
            print(str(result['facial_areas']['img2']['y']) + "," + str(x1) +
                  "," + str(y2) + "," + str(result['facial_areas']['img2']['y']))
        else:
            print(0)
    except:
        print(2)
else:
    print(5)
