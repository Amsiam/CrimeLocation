<x-layouts.app>

    <link href="{{ asset('css/map-style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        var tryjsconfig = {
            "rakhalgachi": {
                "hover": "রাখালগাছি",
                "url": "https://www.google.co.in/",
                "target": "modal",
                "upColor": "red",
                "overColor": "#E850FD",
                "active": true
            },
            "khanpur": {
                "hover": "খানপুর <br>Number of PhD scholar: 26",
                "url": "",
                "target": "new_window",
                "upColor": "#AEB6BF",
                "overColor": "#E850FD",
                "active": true
            },
            "shatgambuj": {
                "hover": "<b><u>ষাটগম্বুজ </u><br><img src='image/example.png'></b>",
                "url": "",
                "target": "new_window",
                "upColor": "#FCF3CF",
                "overColor": "#E850FD",
                "active": true
            },
            "dema": {
                "hover": "ডেমা",
                "url": "",
                "target": "new_window",
                "upColor": "#C39BD3",
                "overColor": "#E850FD",
                "active": true
            },
            "baruipara": {
                "hover": "বারুইপাড়া",
                "url": "",
                "target": "modal",
                "upColor": "#EC7063",
                "overColor": "#E850FD",
                "active": true
            },
            "jatrapur": {
                "hover": "যাত্রাপুর",
                "url": "",
                "target": "new_window",
                "upColor": "#85C1E9",
                "overColor": "#E850FD",
                "active": true
            },
            "bagerhat_s": {
                "hover": "সদর",
                "url": "",
                "target": "new_window",
                "upColor": "#117A65",
                "overColor": "#E850FD",
                "active": true
            },
            "gotapara": {
                "hover": "গোটাপারা",
                "url": "",
                "target": "new_window",
                "upColor": "#D4AC0D",
                "overColor": "#E850FD",
                "active": true
            },
            "bemorta": {
                "hover": "বেমর্তা",
                "url": "",
                "target": "new_window",
                "upColor": "#2E86C1",
                "overColor": "#E850FD",
                "active": true
            },
            "bishnopur": {
                "hover": "বিষনুপুর",
                "url": "",
                "target": "new_window",
                "upColor": "#2E86C1",
                "overColor": "#E850FD",
                "active": true
            },
            "karapara": {
                "hover": "কারাপারা",
                "url": "",
                "target": "new_window",
                "upColor": "rgb(1, 223, 239)",
                "overColor": "#E850FD",
                "active": true
            },
            "bagerhat": {
                "borderColor": "#9CA8B6",
                "active": true
            },

            "general": {
                "borderColor": "#9CA8B6",
                "visibleNames": "#adadad"
            }
        };

        // Add interaction handlers
        document.addEventListener('DOMContentLoaded', function() {
            const overlays = document.querySelectorAll('.region-overlay');
            overlays.forEach(overlay => {
                const regionId = overlay.id;
                const config = tryjsconfig[regionId];

                if (config) {
                    // Set initial color
                    overlay.style.fill = config.upColor;

                    // Hover effects
                    overlay.addEventListener('mouseenter', function() {
                        this.style.fill = config.overColor;
                        showTooltip(config.hover, event);
                    });

                    overlay.addEventListener('mouseleave', function() {
                        this.style.fill = config.upColor;
                        hideTooltip();
                    });

                    // Click handler
                    overlay.addEventListener('click', function() {
                        if (config.url) {
                            if (config.target === 'modal') {
                                // Implement modal handling
                                showModal(config.url);
                            } else if (config.target === 'new_window') {
                                window.open(config.url, '_blank');
                            }
                        }
                    });
                }
            });
        });

        function showTooltip(content, event) {
            const tooltip = document.getElementById('map-tooltip');
            tooltip.innerHTML = content;
            tooltip.style.display = 'block';
            tooltip.style.left = event.pageX + 10 + 'px';
            tooltip.style.top = event.pageY + 10 + 'px';
        }

        function hideTooltip() {
            document.getElementById('map-tooltip').style.display = 'none';
        }

        function showModal(url) {
            // Implement your modal logic here
        }
    </script>

    <style>
        #map-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        #map-tooltip {
            position: absolute;
            display: none;
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .region-overlay {
            transition: fill 0.3s ease;
        }
        .region-path {
            fill: url(#gradient) !important;
        }
    </style>

    <div id="map-container">
        <div id="map-tooltip"></div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-3.181 0 713.784 627.662">

            <defs>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color: red; stop-opacity: 1"/>
                    <stop offset="50%" style="stop-color: blue; stop-opacity: 1"/>
                    <stop offset="100%" style="stop-color: green; stop-opacity: 1"/>
                </linearGradient>
            </defs>

            <path fill="url(#gradient)" d="M 255.842 134.212 C 254.521 131.906 256.335 132.362 256.335 125.997 C 256.335 119.632 271.075 120.544 256.335 119.632 C 241.594 118.72 261.983 107.074 241.594 118.727 C 226.833 127.147 228.332 127.365 228.332 127.365 C 225.07 124.591 221.623 122.008 218.012 119.632 C 212.299 115.845 210.642 117.028 210.642 117.028 C 210.642 117.028 211.628 124.96 204.258 122.759 C 196.888 120.558 194.923 116.909 194.923 116.909 L 182.64 116.909 L 175.763 119.183 L 170.364 127.815 L 161.522 134.18 L 152.188 140.095 L 152.188 162.368 L 157.587 171.919 C 157.587 171.919 156.116 171.919 156.116 182.375 L 156.116 192.831 L 163.487 190.557 L 173.798 189.652 L 187.068 184.986 L 196.888 184.986 L 211.628 177.372 L 223.419 173.736 L 238.652 164.193 L 242.579 157.372 L 246.022 148.277 L 249.957 141.913 L 255.842 134.212 Z M 185.096 241.483 C 185.096 241.483 209.171 217.386 223.419 241.483 L 229.804 248.753 C 229.804 248.753 234.88 249.97 234.717 253.757 C 234.295 263.585 240.616 261.939 240.616 261.939 C 240.616 261.939 235.702 261.49 247 261.939 C 258.298 262.389 252.406 266.487 258.298 262.396 C 264.19 258.304 263.704 263.307 264.197 258.304 C 264.69 253.301 269.596 253.301 264.197 243.301 L 258.791 233.301 L 254.37 223.75 L 251.914 213.75 L 248.964 198.747 C 248.964 198.747 244.144 181.873 234.224 179.196 C 219.048 175.085 216.642 175.832 216.642 175.832 C 216.642 175.832 206.743 184.986 196.888 184.986 L 187.068 184.986 C 187.068 184.986 178.541 183.003 176.17 188.82 C 173.798 194.636 176.17 201.926 176.17 201.926 L 180.676 209.196 C 180.676 209.196 181.169 208.74 181.662 217.834 L 182.155 226.922 L 179.205 233.744 L 185.096 241.483 Z M 269.103 257.848 C 269.103 257.848 273.281 257.187 276.474 257.848 C 287.857 260.28 282.373 261.034 287.286 261.939 L 292.199 262.851 L 303.497 262.851 L 312.339 264.173 C 312.339 264.173 312.996 266.083 316.759 246.453 C 321.451 221.998 324.615 235.092 327.565 223.723 C 330.514 212.356 338.87 213.268 330.514 212.356 C 322.159 211.443 325.6 219.626 322.166 211.45 C 318.73 203.274 329.536 202.811 318.723 203.261 L 307.918 203.717 C 307.918 203.717 313.524 213.023 300.405 203.142 L 287.286 193.261 L 280.895 184.986 C 280.895 184.986 286.301 181.1 273.039 175.832 C 259.776 170.564 274.51 174.193 259.77 170.544 C 245.029 166.896 251.421 169.633 245.037 166.902 L 238.652 164.18 L 220.912 174.497 L 236.916 180.102 L 248.964 198.733 L 251.378 211.013 C 251.378 211.013 253.385 223.281 258.791 233.288 C 261.738 238.618 264.39 244.084 266.732 249.666 L 269.103 257.848 Z M 243.558 293.313 C 243.558 293.313 243.558 290.128 255.842 285.581 L 268.125 281.033 C 268.125 281.033 269.432 279.447 279.916 276.038 C 293.985 271.457 294.199 271.946 294.199 271.946 L 310.868 266.943 L 312.339 264.199 C 312.339 264.199 318.723 272.395 324.622 272.395 C 330.522 272.395 329.043 276.493 343.291 276.493 L 357.538 276.493 L 364.901 278.753 L 376.206 278.753 L 382.098 293.294 L 384.062 301.972 L 384.062 327.888 C 384.062 327.888 396.839 339.255 388.482 342.429 L 380.134 345.594 L 378.206 345.998 C 375.578 346.552 373.014 345.462 371.293 343.539 C 370.4 342.534 367.721 341.9 361.466 342.409 C 344.762 343.771 349.675 346.5 344.762 343.771 C 339.848 341.041 351.146 341.504 339.848 341.047 C 328.551 340.59 339.356 342.409 328.551 340.59 C 317.745 338.774 327.079 338.317 317.745 338.774 C 308.411 339.23 313.324 337.861 308.411 339.23 L 303.497 340.59 L 296.127 341.047 L 279.916 335.098 C 279.916 335.098 277.573 334.193 266.711 333.281 L 255.842 332.376 L 246.022 332.376 L 234.717 331.054 L 223.883 328.324 C 223.883 328.324 221.427 325.138 232.232 316.956 L 232.725 306.038 C 232.725 306.038 232.725 298.766 238.131 296.044 L 243.558 293.313 Z M 294.164 114.51 C 294.164 114.51 265.668 116.75 279.88 114.51 C 285.215 113.677 287.522 114.622 289.686 111.754 C 290.658 110.364 291.488 108.892 292.164 107.359 C 295.599 100.089 287.736 105.99 295.599 100.089 C 303.462 94.186 294.621 99.632 303.454 94.179 L 312.296 88.72 C 311.803 78.264 312.789 85.541 311.803 78.264 C 310.818 70.987 317.702 79.633 310.825 70.993 L 303.948 62.355 L 301.012 54.616 C 301.012 54.616 293.642 54.159 300.519 44.616 L 307.439 35.065 L 313.974 28.244 L 316.281 26.427 L 322.18 26.427 L 334.142 20.062 C 334.142 20.062 348.218 5.058 360.009 20.062 C 360.009 20.062 368.85 20.062 363.937 24.153 L 359.023 28.244 L 368.358 31.886 L 377.691 38.707 L 391.332 51.437 L 397.345 62.349 L 397.345 80.987 L 388.99 93.261 C 388.99 93.261 388.497 94.173 381.134 105.085 C 376.55 111.729 370.079 117.077 362.43 120.544 L 346.718 130.089 C 346.718 130.089 338.37 134.636 337.384 134.18 L 336.406 133.73 C 336.406 133.73 310.868 122.818 299.584 123.267 L 294.185 114.51 L 294.164 114.51 Z M 256.335 125.997 C 256.335 125.997 255.156 132.164 249.95 141.913 C 244.743 151.661 240.808 160.419 240.808 160.419 C 240.808 160.419 237.374 166.024 248.571 168.278 C 259.77 170.532 273.039 175.812 273.039 175.812 C 273.039 175.812 280.895 176.671 280.895 184.967 C 280.895 192.811 283.844 184.967 283.844 184.967 L 292.685 179.625 C 292.685 179.625 293.671 181.45 305.461 179.625 C 317.252 177.802 319.581 175.832 319.581 175.832 L 328.551 164.193 L 334.128 153.67 L 338.87 142.369 L 337.392 134.18 L 310.418 124.794 L 299.584 123.267 L 294.185 114.51 C 294.185 114.51 272.76 115.317 266.732 118.27 C 262.821 120.286 259.306 122.897 256.335 125.997 Z M 399.295 243.757 L 374.728 234.207 L 361.958 229.659 L 349.675 224.207 C 349.675 224.207 331.007 207.405 340.833 188.073 L 352.131 178.284 L 358.024 167.802 L 363.923 155.522 L 366.872 153.644 L 377.185 157.345 L 384.555 156.89 L 387.012 164.16 C 387.012 164.16 398.309 166.427 399.295 181.437 C 399.295 181.437 405.68 192.798 414.521 192.798 C 423.363 192.798 423.855 207.802 417.964 210.987 L 413.05 225.528 L 405.194 233.71 L 399.295 243.757 Z M 481.823 214.431 L 464.634 216.473 L 450.879 220.016 L 435.646 220.016 L 416.978 223.32 L 413.85 223.32 L 417.998 211.046 C 417.998 211.046 425.855 198.74 414.557 192.858 C 411.324 191.098 407.985 189.51 404.558 188.099 L 399.345 181.489 C 399.345 181.489 399.345 164.662 387.062 164.213 L 382.641 153.69 L 406.208 153.69 L 424.84 138.72 C 424.84 138.72 440.552 132.355 449.894 138.72 L 463.126 134.212 C 463.126 134.212 475.903 136.003 465.584 146.46 L 462.641 157.821 C 462.641 157.821 465.584 162.825 473.446 160.095 L 473.939 172.375 L 479.831 175.832 L 478.852 181.919 L 484.044 182.937 C 489.546 184.007 492.682 189.402 490.615 194.239 L 489.657 196.473 L 490.15 204.655 L 489.165 209.652 L 481.823 214.431 Z M 401.752 246.03 L 397.331 259.672 L 395.36 272.402 C 395.36 272.402 392.425 288.753 384.569 290.128 L 384.077 327.868 L 391.218 337.822 L 385.362 343.611 C 385.362 343.611 393.931 351.544 409.136 336.506 L 423.847 328.773 C 423.847 328.773 437.603 332.851 434.66 306.038 L 435.075 291.497 C 435.075 291.497 440.552 295.132 443.994 277.398 L 447.416 259.672 L 444.466 250.584 C 444.466 250.584 444.516 250.346 444.63 249.923 C 445.799 246.014 450.506 244.035 454.457 245.792 C 456.792 246.751 460.214 246.678 465.126 243.77 C 477.403 236.5 480.352 236.5 480.352 236.5 L 480.352 225.567 L 481.823 214.431 L 456.578 218.549 C 456.578 218.549 462.577 218.549 444.98 220.016 L 427.419 221.463 L 413.85 223.32 C 413.85 223.32 401.259 237.861 401.752 246.03 Z M 399.909 69.322 C 401.987 67.002 409.029 60.558 416.428 69.982 C 416.466 70.036 416.509 70.087 416.556 70.134 L 421.17 75.21 C 421.607 75.686 422.182 76.036 422.826 76.222 C 425.105 76.882 430.803 78.833 432.946 82.791 C 435.646 87.795 432.946 85.065 432.946 85.065 L 449.222 78.515 C 449.673 78.334 450.159 78.241 450.651 78.244 L 450.836 78.244 C 452.773 78.244 454.342 79.697 454.342 81.489 L 454.342 86.976 C 454.342 87.513 454.487 88.042 454.764 88.515 L 457.363 92.983 C 457.64 93.457 457.785 93.985 457.785 94.523 L 457.785 101.753 C 457.782 102.142 457.858 102.528 458.007 102.891 L 462.613 114.292 C 462.669 114.43 462.714 114.571 462.748 114.715 L 464.99 123.968 C 465.088 124.404 465.088 124.854 464.99 125.29 L 463.526 132.402 C 463.298 133.522 462.448 134.449 461.292 134.84 L 454.007 137.319 C 452.955 137.677 451.783 137.549 450.85 136.975 C 448.072 135.27 441.237 132.283 432.211 136.631 C 423.312 140.908 418.642 143.955 416.792 145.224 C 416.264 145.585 415.862 146.081 415.635 146.652 C 414.957 148.297 412.693 152.217 406.172 153.684 C 399.324 155.223 387.847 154.239 383.941 153.836 C 383.063 153.746 382.18 153.965 381.47 154.451 L 379.22 155.991 C 378.008 156.825 376.354 156.844 375.12 156.037 L 368.758 151.893 C 368.167 151.511 367.72 150.968 367.479 150.34 L 364.901 143.73 C 364.901 143.73 366.872 144.642 357.045 141.456 C 352.057 139.858 346.813 139.049 341.534 139.063 C 339.95 139.069 338.56 138.087 338.149 136.671 C 337.72 135.214 338.437 133.675 339.877 132.964 L 351.518 127.18 L 351.781 127.035 L 356.288 124.298 C 358.734 122.893 361.458 121.953 364.301 121.536 C 365.858 121.271 368.693 119.454 373.771 113.268 L 383.855 101.047 L 384.055 100.775 L 389.011 93.261 L 396.988 81.536 C 397.236 81.173 397.404 80.768 397.481 80.347 L 399.188 70.874 C 399.273 70.306 399.522 69.77 399.909 69.322 Z M 365.022 143.433 L 342.434 138.932 C 342.257 138.895 342.091 138.823 341.948 138.72 L 341.005 138.059 C 340.248 137.526 339.152 137.951 339.031 138.824 C 339.02 138.908 339.018 138.993 339.027 139.077 L 339.12 139.937 C 339.135 140.085 339.118 140.236 339.07 140.379 L 334.785 153.393 C 334.765 153.452 334.742 153.51 334.713 153.565 L 329.214 163.935 C 329.191 163.978 329.172 164.022 329.157 164.067 C 328.85 164.9 325.515 173.624 320.209 175.64 C 314.903 177.656 300.926 179.91 299.091 180.207 C 298.961 180.227 298.828 180.227 298.698 180.207 L 293.785 179.546 C 293.484 179.503 293.176 179.565 292.921 179.718 L 284.987 184.503 C 284.664 184.702 284.459 185.026 284.429 185.382 L 284.244 187.841 C 284.224 188.139 284.329 188.432 284.536 188.661 L 290.136 194.761 C 290.194 194.823 290.259 194.881 290.328 194.933 L 306.375 206.169 C 307.136 206.698 308.23 206.267 308.345 205.393 C 308.345 205.388 308.346 205.382 308.347 205.376 L 308.439 204.563 C 308.5 203.997 309.004 203.559 309.618 203.539 L 321.837 203.069 C 322.654 203.036 323.279 203.734 323.094 204.47 L 322.094 208.436 C 322.094 208.436 320.73 214.239 324.872 214.067 C 329.015 213.896 333.771 211.391 333.957 212.587 C 334.107 213.585 331.743 216.486 330.943 217.438 C 330.783 217.628 330.694 217.859 330.685 218.099 C 330.685 219.421 330.342 223.962 327.079 226.823 L 323.444 230.016 C 323.304 230.138 323.198 230.29 323.137 230.459 C 322.044 233.288 312.196 258.998 313.71 262.713 C 313.71 262.713 312.653 268.621 320.209 270.591 L 327.714 272.574 L 327.829 272.613 L 334.542 275.032 C 334.685 275.086 334.837 275.112 334.992 275.111 L 344.798 275.111 L 358.031 276.335 C 358.12 276.342 358.21 276.36 358.295 276.388 L 365.344 278.555 C 365.47 278.595 365.603 278.615 365.737 278.615 L 376.028 278.615 C 376.513 278.609 376.955 278.868 377.156 279.276 L 382.755 291.047 C 383.136 291.854 384.317 291.977 384.882 291.269 C 385.018 291.098 385.1 290.895 385.119 290.683 C 385.157 290.276 385.431 289.92 385.833 289.751 C 387.64 288.945 392.768 285.317 395.174 269.698 C 397.581 254.08 401.109 250.24 402.358 249.322 C 402.651 249.102 402.817 248.771 402.809 248.423 L 402.809 244.147 C 402.81 243.311 401.871 242.756 401.052 243.109 L 400.424 243.38 C 400.102 243.509 399.738 243.509 399.417 243.38 L 350.504 224.107 C 350.371 224.055 350.251 223.981 350.147 223.889 C 348.182 222.171 329.107 204.722 341.377 188.006 C 341.433 187.932 341.498 187.863 341.57 187.802 L 352.653 178.198 C 352.727 178.138 352.792 178.069 352.846 177.993 C 353.303 177.332 355.703 173.756 359.895 165.079 C 362.887 158.846 363.516 155.826 363.587 154.503 C 363.623 153.927 364.121 153.469 364.744 153.44 L 369.443 153.162 C 370.357 153.108 370.893 152.185 370.436 151.45 L 365.83 144.008 C 365.66 143.719 365.367 143.511 365.022 143.433 Z" /></svg>
    </div>
</x-layouts.app>
