import qrcode
from PIL import Image
import math
import sys
import base64
from optparse import OptionParser
import StringIO
import os
from datetime import datetime
from random import randint

boxSize = 10;


def makeQR(str, fill, background):

    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_H,
        box_size=boxSize,
        border=0,
    )

    qr.add_data(str)
    qr.make(fit=True)
    qrImage = qr.make_image(fill_color=background, back_color=fill)
    return qrImage


def addBackgroundToQR(qr, color):
    qrWidth, qrHeight = qr.size
    im = Image.new("RGB", (qrWidth+2*boxSize, qrHeight+2*boxSize), color)
    im.paste(qr, (boxSize, boxSize))
    return im


def addImageToQR(qr, path, background):
    im = Image.open(path)

    imWidth, imHeight = im.size
    qrWidth, qrHeight = qr.size

    ratio = math.sqrt((0.15*qrWidth*qrHeight)/(imWidth*imHeight))
    backgroundWidth = imWidth * ratio
    backgroundHeight = imHeight * ratio

    backgroundWidth = ((int)(backgroundWidth/boxSize)) * boxSize
    backgroundHeight = ((int)(backgroundHeight/boxSize)) * boxSize

    background = Image.new("RGB", (backgroundWidth, backgroundHeight), background)

    im.thumbnail((backgroundWidth-boxSize, backgroundHeight-boxSize), Image.ANTIALIAS)
    offset = ((backgroundWidth - im.width)/2, (backgroundHeight - im.height)/2)
    background.paste(im, offset)

    offset = ((qrWidth - backgroundWidth)/2, (qrHeight - backgroundHeight)/2)
    qr.paste(background, offset)

    return qr


parser = OptionParser()
parser.add_option("-t", "--text")
parser.add_option("-f", "--fill", default="#000000")
parser.add_option("-b", "--background", default="#ffffff")
parser.add_option("-i", "--image", default=False)
parser.add_option("-s", "--save", action="store_true")
(options, args) = parser.parse_args()

if not options.text:
    print("Brak argmentu -t")
    raise Exception('Incorrect data')

options.fill = options.fill
options.background = options.background

qrImage = makeQR(options.text, options.fill, options.background)

if options.image:
    qrImage = addImageToQR(qrImage, options.image, options.background)


qrImage = addBackgroundToQR(qrImage, options.background)
output = StringIO.StringIO()
qrImage.save(output, 'PNG')

if options.save:
    name = datetime.now().strftime("%Y%m%d%H%M%S") + str(randint(1000,9999)) + ".png"
    path = os.path.dirname(os.path.abspath(__file__)) + "/../qrs/"
    qrImage.save(path+name)
    print(name)
else:
    base = base64.b64encode(output.getvalue())
    print(base)
    