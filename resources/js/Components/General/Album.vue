<template>
    
    <div class="mb-3 py-2 animate-on-scroll" data-animation="fadeIn">

<div class="shadow-sm bg-white pt-2">
    <div class="h3 p-2 deep-color large-text">Student's Life</div>
    <div class="grid grid-cols-4 grid-rows-1 gap-4 parent-container">

        <div id="album-container" class="child-container mb-2 animate-on-scroll" data-animation="fadeInUp"
            onclick="openAlbum(<?php echo $id ?>)">
            <div class="d-flex align-items-center position-relative w-full">

                <div class="show-first-child card m-2 w-full hover-deep position-relative">

                    <a data-fancybox="album" href="#" class="child stretched-link" data-caption=""></a>

                    <div class="w-full">

                        <div class="w-full ratio ratio-4x3 overflow-hidden">
                            <img
                                src="https://th.bing.com/th/id/OIP._6Xvi4vwg4VfZi-keJRw0AHaEK?pid=ImgDet&rs=1" />
                        </div>


                        <div class="card-body p-2">
                            <div class="card-title m-0 text-truncate mini-text"><small>ggg</small></div>
                        </div>
                    </div>
                </div>


            </div>

        </div>


        <div id="album-container" class="mb-2 animate-on-scroll" data-animation="fadeInUp">
            <div class="d-flex align-items-center position-relative w-full">

                <div class="show-first-child card m-2 w-full hover-deep position-relative">

                    <a href="/education/albums" class="child stretched-link"></a>

                    <div class="w-full">

                        <div class="w-full ratio ratio-4x3 overflow-hidden position-relative">
                            <img
                                src="https://th.bing.com/th/id/OIP._6Xvi4vwg4VfZi-keJRw0AHaEK?pid=ImgDet&rs=1" />
                            <div
                                class="h5 trans-bg position-absolute h-100 d-flex justify-content-center align-items-center">
                                See All
                            </div>
                        </div>


                        <div class="card-body p-2">
                            <div class="card-title m-0 text-truncate mini-text text-center">
                                <small>More</small></div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

</div>


</div>
</template>