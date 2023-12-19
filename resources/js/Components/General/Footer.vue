<script setup>

import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationMark.vue';
</script>

<template>
    <footer class="bg-[#C6DCE4]">
        <div class="container">
            <div class="grid grid-cols-12">
                
                <div class="col-span-12 lg:col-span-6">
                    <div class="flex items-center">
                        <Link :href="route('home')" class="w-12 h-12 sm:w-16 sm:h-16 flex-shrink-0">
                        <ApplicationLogo class="block" />
                        </Link>

                        <div class="text-xl sm:text-xl sm:leading-10 font-medium text-gray-700 font-['Oswald']">
                        Govt. Rajoir Gopalganj K.J.S. Pilot Model Institution & College
                    </div>
                    </div>
                    <div class="grid grid-cols-12">
                    <div class="col-span-8 p-2">

                        <h5 class="mt-3">Contact</h5>
                        <div><small><strong>Address: </strong>Rajoir, Madaripur</small></div>
                        <div><small><strong>Cell: </strong>01716682779</small></div>
                        <div><small><strong>Hours: </strong> 10:00 AM - 4.00 PM, Sat - Thu</small></div>

                        <div class="follow">
                            <h5 class="mt-3">Follow Us</h5>
                            <div class="flex gap-2">
                                <a class="p-1" href="{{ config('informations.facebook') }}"><i
                                        class="footer-link fa-brands fa-facebook-f"></i></a>
                                <a class="p-1" href="{{ config('informations.instagram') }}"><i
                                        class="footer-link fa-brands fa-instagram"></i></a>
                                <a class="p-1" href="{{ config('informations.x') }}"><i
                                        class="footer-link fa-brands fa-x-twitter"></i></a>
                                <a class="p-1" href="{{ config('informations.linkedin') }}"><i
                                        class="footer-link fa-brands fa-linkedin-in"></i></a>
                                <a class="p-1" href="{{ config('informations.youtube') }}"><i
                                        class="footer-link fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4">
                        <h5 class="mt-3">About</h5>
                        <div class="flex flex-col gap-2">
                            <a class="footer-link text-reset text-decoration-none"
                                href="/education/about/about"><small>About
                                    Us</small></a>
                            <a class="footer-link text-reset text-decoration-none"
                                href="/education/about/facilities"><small>Facilities</small></a>
                            <a class="footer-link text-reset text-decoration-none"
                                href="/education/news"><small>Notices</small></a>
                            <a class="footer-link text-reset text-decoration-none"
                                href="/education/career"><small>Career</small></a>
                            <a class="footer-link text-reset text-decoration-none" href="/education/contact"><small>Contact
                                    Us</small></a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="mt-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3666.8959825582892!2d90.04773661173552!3d23.210461078955003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37557d0dbac618af%3A0x4a6138d76a8e58e2!2sGovt.%20Rajoir%20Gopalgonj%20K.J.S%20Pilot%20Model%20institution%20and%20College!5e0!3m2!1sbn!2sbd!4v1693996355714!5m2!1sbn!2sbd"
                            width="100%" height="300" style="border:0;" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center medium-text mt-3">
                © Govt. Rajoir Gopalganj K.J.S Pilot Model Institution & College.
            </div>
            <div class="text-center mini-text mt-1">
                <small>
                    Developed by <a href="https://www.campusitbd.com" class="text-decoration-none">Campus IT BD</a>.
                </small>
            </div>
        </div>
    </footer>
</template>