@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="hero min-h-[90vh] max-w-[1280px] mx-auto"
             style="background-image: url(/images/EHVCT-cover-img.jpg); background-position: 33% 50%;">
        <div class="hero-overlay bg-neutral/60"></div>
        <div class="hero-content flex-col gap-10 text-neutral-content p-0">


            <div class="max-w-[800px] flex flex-col gap-4 justify-items-center items-center">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 1484.000000 877.000000"
                     preserveAspectRatio="xMidYMid meet" class="drop-shadow-2xl px-4">

                    <g transform="translate(0.000000,877.000000) scale(0.100000,-0.100000)"
                       fill="#ffffff" stroke="#ffffff">
                        <path d="M7775 8541 c-77 -8 -106 -20 -129 -53 -18 -26 -21 -77 -5 -111 19
-43 46 -50 199 -57 166 -8 200 -19 265 -91 34 -38 126 -216 140 -272 6 -22 1
-24 -127 -49 -73 -15 -412 -84 -752 -153 -341 -69 -623 -122 -627 -118 -6 8
-129 325 -129 335 0 3 63 8 139 11 151 7 185 17 207 58 33 64 9 136 -53 160
-13 5 -171 9 -350 9 -305 0 -329 1 -367 20 -23 11 -50 34 -61 51 -43 65 -135
81 -185 30 -45 -44 -47 -71 -10 -148 36 -77 69 -117 121 -144 45 -23 141 -39
234 -39 l70 0 83 -233 c46 -127 84 -235 85 -238 2 -7 -281 -369 -288 -369 -3
0 -33 15 -67 34 -139 76 -376 136 -534 136 -214 0 -467 -74 -632 -184 -320
-214 -503 -539 -519 -926 -20 -507 265 -943 736 -1125 237 -92 555 -101 791
-24 88 28 217 89 285 134 140 93 282 256 367 421 66 128 93 215 123 397 8 53
29 47 59 -18 47 -103 114 -167 215 -206 l46 -17 11 -85 c15 -116 20 -131 51
-168 45 -53 73 -59 266 -59 160 0 176 2 200 20 15 12 30 36 36 54 22 80 -25
136 -113 136 -128 0 -196 30 -196 86 0 15 7 27 18 30 65 22 146 68 181 103
132 132 142 367 20 505 -31 35 -32 40 -18 61 58 94 792 1159 814 1184 11 11
15 10 24 -7 13 -24 175 -426 185 -458 6 -19 -6 -30 -76 -80 -268 -188 -424
-458 -458 -796 -22 -219 21 -449 122 -653 75 -151 205 -304 348 -409 71 -53
209 -125 309 -163 297 -112 652 -101 945 27 441 193 709 659 657 1141 -38 349
-205 642 -486 852 -278 207 -675 278 -1039 186 -43 -11 -82 -19 -87 -17 -5 2
-34 62 -63 133 -86 206 -315 725 -376 850 -118 242 -306 337 -605 306z m335
-876 c0 -3 -105 -155 -233 -337 -128 -183 -299 -430 -380 -548 l-148 -215
-107 0 -107 1 -105 280 c-58 153 -130 343 -159 421 -30 79 -52 145 -49 148 3
3 264 57 579 119 316 63 597 118 624 124 60 12 85 14 85 7z m-1355 -785 c70
-184 135 -358 145 -387 l19 -52 -29 -36 c-16 -20 -39 -56 -50 -81 -23 -46 -45
-57 -53 -26 -3 9 -13 53 -22 97 -39 182 -144 382 -279 532 -31 33 -56 65 -56
69 0 4 26 42 57 83 108 144 126 163 134 149 4 -7 64 -164 134 -348z m2712 170
c175 -42 317 -124 445 -259 112 -117 184 -242 234 -407 25 -80 28 -105 28
-249 1 -186 -17 -271 -83 -403 -124 -246 -325 -407 -596 -478 -82 -22 -123
-26 -225 -26 -144 -1 -221 14 -365 67 -129 48 -225 108 -317 198 -362 354
-391 939 -65 1284 63 67 167 147 178 136 11 -12 75 -137 275 -535 l184 -366
45 -18 c38 -14 52 -15 85 -5 48 14 90 62 90 103 0 20 -79 186 -230 484 l-230
452 37 13 c127 42 357 46 510 9z m-3657 -6 c110 -22 270 -87 270 -109 0 -7 -7
-18 -15 -25 -14 -12 -238 -297 -432 -550 -139 -181 -148 -210 -92 -275 l31
-35 432 0 c237 0 455 -3 484 -6 48 -6 52 -9 52 -33 0 -48 -49 -205 -87 -279
-43 -85 -141 -211 -210 -272 -119 -105 -272 -174 -453 -206 -236 -41 -500 28
-709 186 -148 112 -264 289 -317 486 -24 86 -27 118 -27 249 -1 135 2 159 27
239 114 375 407 611 806 650 52 5 166 -4 240 -20z m586 -396 c69 -103 144
-286 144 -352 l0 -21 -307 2 c-170 1 -323 2 -341 2 l-33 1 68 88 c37 48 129
165 203 259 l135 171 43 -41 c23 -23 63 -72 88 -109z m939 -313 c51 -29 80
-61 100 -107 32 -78 7 -183 -53 -226 -37 -27 -42 -18 -42 69 0 33 -6 72 -14
88 -27 51 -97 66 -152 32 -45 -27 -63 -73 -57 -148 3 -36 1 -63 -4 -63 -16 0
-61 54 -77 92 -46 108 17 239 133 278 64 21 109 17 166 -15z"/>
                        <path d="M3473 5564 c-7 -3 -13 -16 -13 -28 0 -17 28 -47 107 -112 l107 -89
-434 -6 c-694 -10 -1625 -32 -2105 -49 -434 -16 -958 -50 -971 -63 -12 -12
510 -42 991 -56 347 -11 1260 -28 2048 -39 l467 -7 -97 -85 c-97 -85 -121
-122 -91 -141 7 -5 52 -9 99 -9 l86 0 94 59 c184 115 359 258 359 292 0 24
-161 153 -320 258 l-115 76 -100 2 c-55 1 -106 0 -112 -3z"/>
                        <path d="M11161 5545 c-99 -57 -387 -271 -404 -300 -13 -24 4 -44 102 -123
107 -86 158 -123 271 -194 l74 -48 91 0 c152 0 153 26 8 147 l-106 88 79 2
c43 1 360 7 704 13 1241 21 2204 48 2480 70 69 5 142 10 163 10 71 0 36 17
-50 24 -672 52 -1702 84 -3176 99 l-198 2 100 80 c96 77 120 107 107 140 -4
12 -25 15 -103 15 -86 0 -103 -3 -142 -25z"/>
                        <path d="M8535 4245 c-86 -16 -203 -57 -273 -97 -84 -47 -211 -174 -259 -259
-86 -150 -120 -303 -110 -498 12 -233 90 -408 251 -558 86 -80 192 -138 321
-175 70 -20 102 -23 250 -23 148 0 180 3 250 24 139 40 229 93 330 195 149
150 212 303 222 536 14 325 -101 576 -335 731 -178 118 -426 165 -647 124z
m308 -179 c182 -86 277 -344 264 -711 -6 -175 -27 -270 -83 -376 -64 -121
-154 -179 -289 -187 -103 -5 -177 21 -248 87 -116 107 -169 255 -183 506 -21
381 98 651 313 705 62 15 165 4 226 -24z"/>
                        <path d="M469 4203 c-19 -51 -6 -69 60 -82 57 -11 81 -28 94 -64 12 -34 9
-1215 -3 -1237 -13 -24 -67 -50 -104 -50 -35 0 -58 -27 -54 -64 l3 -31 656 -3
655 -2 37 215 c27 157 35 221 27 234 -10 21 -76 37 -107 27 -10 -3 -31 -29
-47 -58 -121 -219 -176 -248 -468 -248 l-168 0 0 291 0 292 143 -5 c173 -6
190 -13 226 -87 28 -60 58 -79 103 -68 l25 7 5 187 c3 104 3 205 0 226 l-4 38
-47 -3 c-44 -3 -47 -5 -71 -52 -42 -83 -56 -88 -229 -94 l-151 -5 0 253 0 252
178 -4 c246 -6 276 -21 357 -176 l40 -77 45 -3 c74 -4 72 -10 63 214 l-8 199
-623 3 -622 2 -11 -27z"/>
                        <path d="M2017 4223 c-10 -3 -22 -16 -28 -30 -14 -39 9 -66 69 -81 94 -25 87
30 87 -668 0 -694 8 -633 -86 -664 l-54 -17 0 -44 0 -44 354 -3 c381 -2 371
-4 371 49 0 33 -13 44 -68 59 -57 15 -78 38 -85 91 -3 24 -4 298 -4 609 2 647
-3 607 89 635 55 16 68 27 68 62 0 52 -5 53 -363 52 -183 -1 -340 -3 -350 -6z"/>
                        <path d="M4005 4223 c-35 -5 -45 -18 -45 -54 0 -34 12 -43 81 -63 100 -28 94
2 97 -470 l3 -411 -28 40 c-15 22 -92 128 -170 235 -79 107 -185 251 -235 320
-50 69 -137 187 -192 262 l-101 137 -271 1 c-295 0 -284 2 -284 -55 0 -30 18
-44 80 -60 99 -26 91 36 88 -656 l-3 -607 -24 -26 c-14 -15 -42 -32 -64 -38
-45 -14 -65 -48 -48 -85 l11 -23 285 0 285 0 6 26 c12 48 -8 70 -76 83 -81 16
-106 41 -114 112 -6 54 -26 696 -26 832 0 61 2 69 14 57 8 -8 170 -229 362
-490 191 -261 371 -508 401 -547 l53 -73 135 0 135 0 0 675 c0 769 -4 731 76
760 77 26 79 29 79 71 l0 39 -75 6 c-85 7 -390 8 -435 2z"/>
                        <path d="M4630 4221 c-32 -5 -35 -10 -38 -42 -4 -42 6 -51 70 -69 90 -24 83
29 83 -662 l0 -610 -28 -24 c-16 -14 -49 -30 -73 -36 -47 -13 -59 -32 -52 -79
l3 -24 460 0 460 1 90 28 c271 83 439 264 502 540 25 107 22 327 -6 431 -36
137 -93 238 -185 330 -129 127 -279 192 -497 215 -106 11 -729 12 -789 1z
m833 -189 c110 -54 194 -169 232 -316 28 -110 38 -266 26 -384 -20 -191 -65
-306 -156 -397 -79 -80 -176 -115 -316 -115 -120 0 -108 -64 -108 583 0 309 2
586 6 616 l6 53 122 -4 c113 -4 127 -6 188 -36z"/>
                        <path d="M6235 4220 c-59 -5 -60 -5 -63 -38 -4 -43 10 -59 59 -67 22 -4 52
-17 67 -30 l27 -23 3 -598 c2 -422 -1 -607 -9 -626 -7 -18 -27 -33 -62 -47
-81 -33 -82 -35 -82 -77 l0 -39 355 0 355 0 3 36 c3 41 -4 48 -71 73 -84 31
-82 23 -79 389 l2 247 265 0 265 0 0 -277 c-1 -216 -4 -284 -14 -303 -8 -14
-41 -37 -78 -55 -53 -25 -64 -35 -66 -58 -7 -58 -11 -57 364 -57 l344 0 11 26
c12 33 -11 74 -42 74 -11 0 -35 7 -55 15 -65 27 -64 17 -64 667 0 444 3 589
13 608 7 14 30 33 52 43 89 40 90 41 90 77 l0 35 -146 5 c-80 3 -239 3 -355 0
l-209 -5 -3 -34 c-4 -41 6 -51 65 -72 85 -28 88 -38 91 -290 l3 -219 -265 0
-266 0 0 224 c0 257 1 262 89 291 27 9 52 23 55 31 10 27 7 64 -6 69 -21 6
-578 11 -643 5z"/>
                        <path d="M11115 4214 c-10 -10 -15 -29 -13 -47 3 -28 8 -31 68 -48 72 -19 87
-34 95 -93 3 -22 5 -301 3 -619 l-3 -579 -27 -23 c-15 -13 -52 -29 -83 -35
l-56 -12 3 -41 3 -42 652 -3 c614 -2 652 -1 656 15 3 10 20 111 38 225 25 154
30 211 22 219 -6 6 -31 14 -56 16 -53 6 -65 -3 -117 -98 -44 -81 -132 -170
-185 -188 -25 -9 -110 -15 -232 -18 l-193 -5 0 292 0 292 144 -4 c167 -4 182
-10 227 -92 30 -55 43 -66 80 -66 47 0 49 9 49 242 l0 218 -42 0 c-53 0 -57
-3 -88 -65 -36 -73 -56 -80 -230 -80 l-145 0 0 60 c0 33 1 144 3 248 l2 187
139 0 c213 0 300 -23 344 -89 14 -21 39 -65 55 -98 33 -64 45 -73 95 -73 60 0
59 -2 48 206 -6 104 -11 195 -11 202 0 9 -130 12 -614 12 -554 0 -616 -2 -631
-16z"/>
                        <path d="M9414 4206 c-3 -8 -4 -27 -2 -43 3 -24 10 -30 58 -45 74 -24 99 -54
153 -189 24 -63 147 -368 272 -679 125 -311 229 -571 232 -577 7 -18 257 -18
270 0 5 6 65 167 133 357 291 817 361 1006 378 1030 10 14 44 38 75 53 55 27
57 29 57 68 l0 39 -267 -2 c-250 -3 -268 -4 -271 -21 -8 -43 7 -64 53 -76 53
-13 85 -41 85 -74 0 -31 -33 -137 -135 -432 -48 -137 -103 -298 -122 -357 -19
-60 -39 -108 -43 -108 -4 0 -10 10 -13 23 -2 12 -77 209 -166 438 -88 229
-161 427 -161 441 0 29 33 62 75 75 26 8 30 15 33 51 l3 42 -346 0 c-289 0
-347 -2 -351 -14z"/>
                        <path d="M12582 4208 c-31 -31 -6 -83 45 -93 42 -8 94 -32 105 -49 4 -6 8
-276 8 -599 0 -490 -2 -593 -14 -622 -12 -27 -28 -41 -73 -63 -56 -27 -58 -29
-58 -67 l0 -40 287 -3 288 -2 6 24 c13 55 4 65 -90 93 -103 31 -96 -1 -106
534 -5 255 -8 464 -7 466 2 1 46 -57 100 -130 53 -73 178 -242 277 -377 100
-135 241 -327 313 -427 l132 -183 138 0 137 0 0 675 c0 551 3 682 14 709 13
32 28 41 109 66 35 11 37 13 37 56 l0 44 -274 0 -274 0 -7 -29 c-10 -46 7 -66
68 -80 68 -15 94 -39 102 -93 3 -24 5 -211 3 -416 l-3 -373 -56 78 c-101 142
-440 605 -556 761 l-113 152 -263 0 c-191 0 -266 -3 -275 -12z"/>
                        <path d="M2162 1932 c-18 -53 -42 -123 -54 -154 l-20 -58 -170 -2 -171 -3 140
-94 140 -94 -49 -140 c-27 -77 -47 -144 -46 -148 2 -4 62 30 133 76 72 47 135
85 140 85 6 0 68 -38 140 -85 71 -46 131 -83 133 -80 2 2 -19 69 -47 149 l-50
146 68 47 c37 27 98 68 134 93 37 25 67 47 67 50 0 3 -75 5 -167 5 l-168 0
-55 152 c-30 84 -57 153 -60 153 -3 0 -20 -44 -38 -98z"/>
                        <path d="M12024 1872 l-50 -157 -174 -5 -173 -5 124 -83 c68 -45 132 -88 141
-95 15 -12 13 -25 -31 -158 -27 -79 -47 -145 -46 -147 2 -2 63 36 136 85 l133
89 139 -89 c76 -48 141 -87 143 -84 2 2 -18 68 -46 146 -27 78 -50 146 -50
151 0 5 53 45 118 90 127 86 152 105 152 111 0 2 -77 3 -170 1 l-171 -3 -16
38 c-8 21 -33 88 -55 148 -21 61 -42 113 -46 117 -4 3 -30 -64 -58 -150z"/>
                        <path d="M3266 1903 c-70 -21 -167 -119 -187 -188 -21 -73 -17 -190 8 -245 26
-59 94 -127 151 -153 72 -32 209 -36 285 -7 32 12 70 32 85 45 l26 23 -28 37
c-37 48 -49 51 -85 25 -45 -31 -126 -45 -179 -31 -51 14 -110 64 -128 108 -8
18 -14 57 -14 88 0 70 17 112 63 152 68 60 169 67 253 18 l42 -25 36 43 36 42
-32 27 c-17 15 -52 34 -76 43 -58 19 -191 19 -256 -2z"/>
                        <path d="M4594 1900 c-72 -28 -128 -80 -163 -152 -27 -52 -31 -72 -31 -138 0
-105 21 -161 84 -226 73 -74 141 -98 261 -92 93 5 152 24 204 66 l25 20 -38
47 c-34 41 -40 45 -55 32 -63 -56 -176 -69 -247 -28 -109 62 -134 213 -51 308
73 83 187 95 280 31 l28 -20 38 44 c45 50 43 56 -33 96 -71 36 -225 42 -302
12z"/>
                        <path d="M6548 1913 l-58 -4 0 -197 -1 -197 -25 30 c-13 17 -81 105 -151 198
l-126 167 -70 0 -69 0 6 -31 c3 -17 6 -155 6 -305 l0 -274 60 0 60 0 2 203 3
202 153 -202 153 -203 59 0 60 0 0 310 c0 171 -1 309 -2 308 -2 -1 -29 -3 -60
-5z"/>
                        <path d="M6983 1899 c-61 -24 -132 -89 -164 -150 -31 -60 -38 -187 -15 -257
23 -67 84 -135 154 -169 52 -26 67 -28 168 -28 107 0 113 1 180 35 l69 35 3
138 3 137 -131 0 -130 0 0 -55 0 -55 65 0 65 0 0 -50 c0 -63 -18 -75 -120 -75
-61 0 -82 4 -112 23 -50 31 -77 71 -90 134 -15 74 2 131 56 184 68 69 164 81
258 33 l42 -22 33 39 c18 22 33 42 33 46 0 12 -57 48 -101 63 -62 22 -201 19
-266 -6z"/>
                        <path d="M8650 1911 c-91 -28 -176 -107 -204 -188 -9 -27 -16 -80 -16 -123 0
-66 4 -86 30 -138 35 -68 82 -115 149 -146 67 -31 226 -30 293 1 66 30 132 95
159 156 34 74 33 201 -1 272 -33 68 -99 129 -166 154 -57 22 -191 28 -244 12z
m203 -126 c22 -10 51 -36 65 -58 24 -36 27 -51 27 -122 0 -70 -3 -86 -25 -118
-68 -99 -219 -113 -300 -28 -128 134 -33 361 145 348 28 -2 67 -12 88 -22z"/>
                        <path d="M10843 1904 c-85 -31 -136 -126 -112 -211 21 -76 70 -106 258 -153
45 -12 91 -49 91 -73 0 -8 -8 -25 -19 -38 -14 -18 -31 -23 -78 -27 -68 -5
-120 8 -176 45 -22 13 -40 23 -41 21 -1 -2 -17 -22 -35 -46 -32 -41 -33 -44
-15 -58 94 -73 292 -96 392 -45 101 52 133 180 65 261 -33 40 -81 64 -173 85
-96 23 -128 39 -136 69 -20 82 116 109 224 45 18 -10 34 -19 36 -19 1 0 17 20
35 45 l32 45 -33 20 c-80 49 -227 65 -315 34z"/>
                        <path d="M3730 1904 c0 -3 52 -89 116 -191 l117 -185 -5 -97 c-6 -135 -9 -131
68 -131 l64 0 0 128 0 127 110 172 c61 95 110 175 110 178 0 3 -31 5 -69 5
l-69 0 -74 -121 c-85 -140 -69 -142 -164 20 l-59 101 -72 0 c-40 0 -73 -3 -73
-6z"/>
                        <path d="M5130 1605 l0 -305 215 0 215 0 0 55 0 55 -150 0 -150 0 0 250 0 250
-65 0 -65 0 0 -305z"/>
                        <path d="M5710 1605 l0 -305 60 0 59 0 3 305 3 305 -62 0 -63 0 0 -305z"/>
                        <path d="M7790 1855 l0 -55 100 0 100 0 0 -250 0 -250 65 0 65 0 0 250 0 250
100 0 100 0 0 55 0 55 -265 0 -265 0 0 -55z"/>
                        <path d="M9260 1704 c0 -227 7 -274 52 -328 53 -64 98 -81 218 -81 115 0 158
14 212 72 56 59 62 89 66 326 l4 217 -66 0 -66 0 0 -197 c0 -171 -3 -204 -19
-239 -45 -100 -215 -99 -257 1 -11 26 -14 83 -14 235 l0 200 -65 0 -65 0 0
-206z"/>
                        <path d="M10020 1898 c0 -7 0 -139 -1 -293 0 -154 0 -286 0 -292 1 -9 20 -13
60 -13 l58 0 7 61 c3 34 6 77 6 95 l0 34 64 0 63 0 63 -95 63 -95 73 0 c41 0
74 2 74 5 0 5 -47 75 -107 157 l-34 47 28 15 c37 19 79 64 92 99 15 39 14 131
-3 170 -17 43 -76 93 -123 106 -57 16 -383 14 -383 -1z m343 -110 c34 -18 46
-40 47 -81 0 -81 -42 -107 -174 -107 -82 0 -84 1 -90 26 -4 14 -4 59 0 100 l7
74 94 0 c53 0 104 -5 116 -12z"/>
                        <path d="M3970 689 c-697 -14 -1341 -42 -1725 -74 -93 -8 -178 -15 -189 -15
-11 0 -17 -2 -15 -4 7 -7 309 -34 504 -46 99 -6 252 -15 340 -20 905 -54 2336
-74 4750 -67 2130 7 2622 15 3610 63 482 23 991 58 1003 68 4 4 -233 25 -473
41 -260 17 -578 32 -1015 47 -404 13 -6179 20 -6790 7z"/>
                        <path d="M6029 355 c-3 -2 -203 -5 -445 -6 -635 -3 -1335 -25 -1769 -54 -374
-26 -400 -28 -419 -35 -10 -3 51 -12 135 -18 741 -58 1834 -77 4114 -69 908 3
1799 10 1980 16 512 16 832 30 1049 46 109 8 206 15 215 16 58 3 -73 20 -262
33 -555 40 -847 51 -1807 66 -620 10 -2783 14 -2791 5z"/>
                    </g>
                </svg>

                <header class="px-4 flex flex-col gap-4 justify-items-center items-center">
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight text-balance text-pretty">
                        Easy rides. Great stories. Better views
                    </h1>
                    <p class="text-lg opacity-95 text-balance">
                        Relaxed group rides through Brabant countryside. Perfect for expats and locals.
                    </p>
                </header>

                <div class="flex flex-wrap gap-3">
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">Book a tour</a>
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">See all tours</a>
                </div>

{{--                <div class="mt-6 flex flex-wrap gap-3 text-sm opacity-95">--}}
{{--                    <span class="badge badge-primary">Local guide</span>--}}
{{--                    <span class="badge badge-primary">Beginner-friendly</span>--}}
{{--                    <span class="badge badge-primary">Expats & locals</span>--}}
{{--                    <span class="badge badge-primary">Small groups</span>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>


    {{-- HIGHLIGHTS --}}
    {{--    <div class="mask-container">--}}

    <div class="mask-box">

        {{-- FEATURED TOURS --}}
        <section class="max-w-5xl mx-auto px-4 pb-14 above-mask-box">
            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-3xl font-bold">Popular tours</h2>
                    <p class="opacity-80 mt-1">Pick a ride, choose a date, and you’re set.</p>
                </div>
                <a class="btn btn-outline" href="{{ route('tours.index') }}">All tours</a>
            </div>

            <div class="mx-auto grid grid-cols-[repeat(auto-fit,minmax(min(100%,18rem),1fr))] gap-6">
                @forelse($tours as $tour)
                    <article class="bg-white/80 shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl max-w-[18rem]">
                        <h3 class="text-lg font-bold text-black truncate block capitalize py-2 px-4">{{ $tour->title }}</h3>

                        <a href="{{ route('tours.show', $tour) }}" title="{{ $tour->title }}">
                            @if($tour->cover_url)
                                <figure class="aspect-[16/10] h-80 w-full object-cover rounded-t-xl">
                                    <img src="{{ $tour->cover_url }}"
                                         alt="{{ $tour->cover_media?->alt_text ?? $tour->title }}"
                                         class="w-full h-full object-cover">
                                </figure>
                            @else
                                <div class="aspect-[16/10] bg-base-200 flex items-center justify-center opacity-70">
                                    No image yet
                                </div>
                            @endif
                            {{--                    <img src="{{ $tour  }}" alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />--}}
                            <div class="px-4 py-3 w-72">
                                {{--                        <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>--}}
                                @if($tour->next_slot_at)
                                    <p class="text-sm badge badge-outline badge-neutral">
                                        Next
                                        available: {{ \Illuminate\Support\Carbon::parse($tour->next_slot_at)->format('D d M, H:i') }}
                                    </p>
                                @endif
                                <div class="flex items-center">
                                    {{--                            todo get 'from price'--}}
                                    {{--                            <p class="text-lg font-semibold text-black cursor-auto my-3">&euro;20</p>--}}
                                    @if($tour->starting_from_cents !== null)
                                        <div class="cursor-auto my-3 ml-2 flex flex-col">
                                            <div class="text-sm opacity-70">Starting from</div>
                                            <div
                                                class="text-lg font-semibold">{{ $tour->starting_from_formatted }}</div>
                                        </div>
                                    @endif
                                    {{--                            <del>--}}
                                    {{--                                <p class="text-sm text-gray-600 cursor-auto ml-2">$199</p>--}}
                                    {{--                            </del>--}}
                                    <div class="card-actions justify-end mt-2 ml-auto">
                                        <span class="btn btn-accent btn-md">View</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <p>No tours yet.</p>
                @endforelse
            </div>

        </section>

    </div>

    {{--    </div>--}}


    {{-- HOW BOOKING WORKS --}}
    <section class="bg-base-100/60 mx-auto px-4 py-14 z-10">
        <div class="max-w-6xl grid grid-cols-[repeat(auto-fit,minmax(min(100%,10rem),1fr))] gap-6">
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="card-title">Local guide</h2>
                    <p class="text-sm opacity-80">Maurice was born and raised in Eindhoven.</p>
                </div>
                <figure class="aspect-[3/4] h-40 w-full object-cover">
                    <img
                        src="/images/EHVCT_Maurice_cover_cropped.jpg"
                        alt="Maurice on the bike" class="w-full h-full object-cover"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="card-title">Relaxed pace</h2>
                    <p class="text-sm opacity-80">Not a race. Just a good ride together.</p>
                </div>
                <figure class="aspect-[3/4] h-40 w-full object-cover">
                    <img
                        src="/images/EHVCT-bike-sunset.jpg"
                        alt="Bike with sun setting in the background" class="w-full h-full object-cover"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="card-title">Great stops</h2>
                    <p class="text-sm opacity-80">Coffee, views, and local favorites along the way.</p>
                </div>
                <figure class="aspect-[3/4] h-40 w-full object-cover">
                    <img
                        src="/images/EHVCT-mill-oerle.jpg"
                        alt="View of the Mill Oerle" class="w-full h-full object-cover"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="card-title">Meet people</h2>
                    <p class="text-sm opacity-80">A friendly mix of expats and locals.</p>
                </div>
                <figure class="aspect-[3/4] h-40 w-full object-cover">
                    <img
                        src="/images/EHVCT-people-cartoon.jpg"
                        alt="people on the border of the Netherlands and Belgium" class="w-full h-full object-cover"/>
                </figure>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 py-14">
            <h2 class="text-3xl font-bold mb-8">Booking is simple</h2>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">1</div>
                        <h3 class="font-semibold">Choose a tour</h3>
                        <p class="text-sm opacity-80">Pick your route and vibe.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">2</div>
                        <h3 class="font-semibold">Select a date & group size</h3>
                        <p class="text-sm opacity-80">See available spots instantly.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">3</div>
                        <h3 class="font-semibold">Pay online</h3>
                        <p class="text-sm opacity-80">You’ll receive a confirmation email right away.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}

    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl font-bold mb-4">Meet your guide</h2>
                <div class="avatar" style="float: left; margin-right: 1.5rem; shape-outside: circle();">
                    <div class="ring-accent ring-offset-base-100 w-24 rounded-full ring-2 ring-offset-2">
                        <img src="/images/EHVCT_Maurice_avatar.jpg"/>
                    </div>
                </div>
                <p class="mt-4 opacity-85">
                    Eindhoven Cycling Tours was founded by Maurice Meijer, born and raised in Eindhoven.
                    Today ECT brings people together on easy-going rides through nature, villages, and hidden
                    highlights.
                </p>
                <div class="mt-6 flex gap-3">
                    <a class="btn btn-outline" href="#">Read more</a>
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">Book a tour</a>
                </div>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="font-semibold">Also available</h3>
                    <p class="text-sm opacity-80">Private tours, company outings, and teambuilding rides.</p>
                    <a class="btn btn-outline" href="{{ route('contact.show') }}">Request a private tour</a>
                </div>
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="bg-accent text-accent-content">
        <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold">Ready to ride?</h2>
                <p class="opacity-90 mt-1">Choose a tour and grab your spot.</p>
            </div>
            <div class="flex gap-3">
                <a class="btn btn-neutral" href="{{ route('tours.index') }}">Book a tour</a>
                <a class="btn btn-outline border-accent-content text-accent-content" href="{{ route('contact.show') }}">Ask
                    a question</a>
            </div>
        </div>
    </section>
    {{-- FAQ --}}
    <section class="bg-base-200">
        <div class="max-w-4xl mx-auto px-4 py-14">
            <h2 class="text-3xl font-bold mb-8 text-center">Frequently asked questions</h2>

            <div class="space-y-3">

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion" checked="checked"/>
                    <div class="collapse-title font-semibold">
                        Do I need to bring my own bike?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        You can bring your own bike or rent one nearby. We can recommend local rental partners in
                        Eindhoven.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        How difficult are the tours?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        The rides are relaxed and beginner-friendly. We keep a comfortable pace and take regular breaks.
                        You do not need to be sporty to join.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        What happens if the weather is bad?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        Light rain is usually fine. If conditions are unsafe we reschedule or refund the tour.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        Can I cancel my booking?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        You can cancel up to the allowed cutoff time before the tour. After that the booking is final
                        because the spot has been reserved.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        Is the tour in English or Dutch?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        Both. Maurice speaks English and Dutch, so everyone can follow along comfortably.
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
