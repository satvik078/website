import cv2 as cv
import sys
img= cv.imread(cv.samples.findFile("large_1503_041573666d_a8c4781e6e (1).png"))
if img is None:
    sys.exit("could not read the img.")
cv.imshow("display windows", img)
k=cv.waitKey(0)


if k==ord("s"):
    cv.imwrite("output.png", img)
    print("Image saved!")