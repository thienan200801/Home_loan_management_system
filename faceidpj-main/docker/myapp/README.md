# Introduction

Server: faceid.duckdns.org
Connect: ssh root@faceid.duckdns.org
Make dir /opt/face_recognizer/training/[name of person]
Input some face images to folder /opt/face_recognizer/training/[name of person]/
## Train Data
./detector.py --train

## Recon FaceID
./detector.py --test -f /path/to/image


# Application
Download Elon Musk Image in Internet and upload to https://faceid.duckdns.org/
It will show Hello Elon Musk


# Component

## Apps as a Service with Embedded foundation models (SaaS)
Apache, PHP Service:
URL: https://faceid.duckdns.org/
Location: /var/www/html/
Code: /var/www/html/upload.php

## Data Sources
Save Face ID image at /opt/face_recognizer/training/[name of person]/[images of person]

## Data Platforms
Using Pickle to Save Face ID data trained at /opt/face_recognizer/output/encodings.pkl

## Context management and caching
[Todo]

## Model hub
Model: HOG (histogram of oriented gradients) is a common technique for object detection. For this tutorial, you only need to remember that it works best with a CPU.


## Open Source foundation Models
https://github.com/ageitgey/face_recognition

## Prompt Libary
Numpy: Linear algebra
np.linalg.norm(face_encodings - face_to_compare, axis=1)
