<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


</script>

<template>
    <AppLayout title="Candidate">
        <section class="relative lg:pb-24 pb-16 m-4 sm:m-0">

            <div class="container lg:mt-24 mt-16">
                <div class="md:flex">
                    <div class="lg:w-1/4 md:w-1/3 md:px-3">
                        <div class="">
                            <div class="p-6 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                                <div class="profile-pic text-center mb-5">
                                    <input id="pro-img" name="profile-image" type="file" class="hidden" onchange="loadFile(event)">
                                    <div>
                                        <div class="relative h-28 w-28 mx-auto">
                                            <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="rounded-full shadow dark:shadow-gray-800 ring-4 ring-slate-50 dark:ring-slate-800" id="profile-image" alt="">
                                            <label class="absolute inset-0 cursor-pointer" for="pro-img"></label>
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="text-lg font-semibold">Jenny Jimenez</h5>
                                            <p class="text-slate-400">jennyhot@hotmail.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 dark:border-gray-700">
                                    <div>
                                        
                                        <div class="mt-6">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Email :</h6>
                                                    <a href="" class="text-slate-400">jennyhot@hotmail.com</a>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-italic fea icon-ex-md text-slate-400 mr-3">
                                                    <line x1="19" y1="4" x2="10" y2="4"></line>
                                                    <line x1="14" y1="20" x2="5" y2="20"></line>
                                                    <line x1="15" y1="4" x2="9" y2="20"></line>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Language :</h6>
                                                    <a href="" class="text-slate-400">English</a>, <a href="" class="text-slate-400">Japanese</a>, <a href="" class="text-slate-400">Chinese</a>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe fea icon-ex-md text-slate-400 mr-3">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Website :</h6>
                                                    <a href="" class="text-slate-400">www.kristajoseph.com</a>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift fea icon-ex-md text-slate-400 mr-3">
                                                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                                    <rect x="2" y="7" width="20" height="5"></rect>
                                                    <line x1="12" y1="22" x2="12" y2="7"></line>
                                                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Birthday :</h6>
                                                    <p class="text-slate-400 mb-0">2nd March, 1996</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Location :</h6>
                                                    <a href="" class="text-slate-400">Beijing, China</a>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-indigo-600 dark:text-white font-medium mb-0">Cell No :</h6>
                                                    <a href="" class="text-slate-400">(+12) 1254-56-4896</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-3/4 md:w-2/3 md:px-3 mt-[30px] md:mt-0">
                        <div class="pb-6 border-b border-gray-100 dark:border-gray-700">
                            <h5 class="text-xl font-semibold">Jenny Jimenez</h5>

                            <p class="text-slate-400 mt-3">I have started my career as a trainee and prove my self and achieve all the milestone with good guidance and reach up to the project manager. In this journey, I understand all the procedure which make me a good developer, team leader, and a project manager.</p>
                        </div>

                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] pt-6">
                        
                            <div class="mt-[30px] lg:mt-0">
                                <h5 class="text-xl font-semibold">Experience :</h5>

                                <div v-for="n in 3" class="flex transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">Senior Web Developer</h4>
                                        <p class="text-slate-400 mb-0">3 Years Experience</p>
                                        <p class="text-slate-400 mb-0"><a href="" class="text-indigo-600">CircleCi</a> @London, UK</p>
                                    </div>

                                </div>

                            </div>

                            <div class="mt-[30px] lg:mt-0">
                                <h5 class="text-xl font-semibold">Formação academica :</h5>

                                <div v-for="n in 3" class="flex transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">Senior Web Developer</h4>
                                        <p class="text-slate-400 mb-0">3 Years Experience</p>
                                        <p class="text-slate-400 mb-0"><a href="" class="text-indigo-600">CircleCi</a> @London, UK</p>
                                    </div>
                                </div>


                                <h5 class="text-xl font-semibold mt-[30px]">Cursos</h5>

                                <div v-for="n in 3" class="flex transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">Senior Web Developer</h4>
                                        <p class="text-slate-400 mb-0">3 Years Experience</p>
                                        <p class="text-slate-400 mb-0"><a href="" class="text-indigo-600">CircleCi</a> @London, UK</p>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <h5 class="text-xl font-semibold mt-[30px]">Portfolio :</h5>

                        <div class="grid lg:grid-cols-3 md:grid-cols-2 mt-6 gap-[30px]">
                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                <div class="content transition-all duration-500">
                                    <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                        <a href="assets/images/portfolio/1.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                    </div>

                                    <div class="title absolute z-10 hidden group-hover:block bottom-6 left-6">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                <div class="content transition-all duration-500">
                                    <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                        <a href="assets/images/portfolio/2.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                    </div>

                                    <div class="absolute z-10 hidden group-hover:block bottom-6 left-6 transition-all duration-500">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                    <div class="content transition-all duration-500">
                                        <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                            <a href="assets/images/portfolio/3.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                        </div>

                                    <div class="absolute z-10 hidden group-hover:block bottom-6 left-6 transition-all duration-500">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                <div class="content transition-all duration-500">
                                    <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                        <a href="assets/images/portfolio/4.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                    </div>

                                    <div class="absolute z-10 hidden group-hover:block bottom-6 left-6 transition-all duration-500">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                <div class="content transition-all duration-500">
                                    <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                        <a href="assets/images/portfolio/5.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                    </div>

                                    <div class="absolute z-10 hidden group-hover:block bottom-6 left-6 transition-all duration-500">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group relative block overflow-hidden rounded-md transition-all duration-500">
                                <img src="https://shreethemes.in/techwind/layouts/assets/images/client/05.jpg" class="group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                                <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md"></div>

                                <div class="content transition-all duration-500">
                                    <div class="icon absolute z-10 hidden group-hover:block top-6 right-6 transition-all duration-500">
                                        <a href="assets/images/portfolio/6.jpg" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white btn-icon rounded-full lightbox"><i class="uil uil-camera"></i></a>
                                    </div>

                                    <div class="absolute z-10 hidden group-hover:block bottom-6 left-6 transition-all duration-500">
                                        <a href="portfolio-detail-three.html" class="h6 text-lg font-medium hover:text-indigo-600 duration-500 ease-in-out">Mockup Collection</a>
                                        <p class="text-slate-400 mb-0">Abstract</p>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
                <!--end grid-->
            </div>
        <!--end container-->
        </section>
    </AppLayout>
</template>