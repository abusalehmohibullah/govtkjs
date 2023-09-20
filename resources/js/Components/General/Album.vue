<template>
    
    <div class="mb-3 py-2 animate-on-scroll" data-animation="fadeIn">

<div class="shadow-sm bg-white pt-2 rounded">
    <div class="text-2xl font-bold p-2">Image Gallery</div>
    <div class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 parent-container">

        <div id="album-container" class="child-container mb-2 animate-on-scroll" data-animation="fadeInUp"
            onclick="openAlbum(<?php echo $id ?>)">
            <div class="d-flex align-items-center position-relative w-full">

                <div class="show-first-child card m-2 w-full hover-deep position-relative">

                    <a data-fancybox="album" href="#" class="child stretched-link" data-caption=""></a>

                    <div class="w-full rounded bg-[#C6DCE4]">

                        <div class="w-full ratio ratio-4x3 overflow-hidden">
                            <img
                                src="https://th.bing.com/th/id/OIP._6Xvi4vwg4VfZi-keJRw0AHaEK?pid=ImgDet&rs=1" />
                        </div>


                        <div class="card-body p-2">
                            <div class="text-gray-700 text-xl font-bold m-0 text-truncate mini-text"><small>ggg</small></div>
                        </div>
                    </div>
                </div>


            </div>

        </div>


        <div id="album-container" class="mb-2 animate-on-scroll" data-animation="fadeInUp">
            <div class="d-flex align-items-center position-relative w-full">

                <div class="show-first-child card m-2 w-full hover-deep position-relative">

                    <a href="/education/albums" class="child stretched-link"></a>

                    <div class="w-full rounded bg-[#C6DCE4]">

                        <div class="w-full ratio ratio-4x3 overflow-hidden position-relative">
                            <img
                                src="https://th.bing.com/th/id/OIP._6Xvi4vwg4VfZi-keJRw0AHaEK?pid=ImgDet&rs=1" />
                            <div
                                class="h5 absolute h-100 flex justify-center items-center bg-slate-400/50">
                                <span class="text-gray-800 opacity-100 text-2xl font-bold">See All</span>
                            </div>
                        </div>


                        <div class="card-body p-2">
                            <div class="text-gray-700 text-xl font-bold m-0 text-truncate mini-text text-center">
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