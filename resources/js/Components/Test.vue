<template>
    <div class="flex justify-between items-center">
      <template v-for="step in totalSteps">
        <div class="flex items-center">
          <div
            :class="{
              'w-6 h-6 flex justify-center items-center rounded-full text-white bg-yellow-400': step === currentStep,
              'w-6 h-6 flex justify-center items-center bg-black text-white': step < currentStep,
              'w-6 h-6 flex justify-center items-center bg-white text-black': step > currentStep
            }"
          >
            <template v-if="step > currentStep">
              {{ step }}
            </template>
            <template v-else>
              <svg class="w-4 h-4">
                <path
                  fill="currentColor"
                  d="M5.6 14.8L19.2 1.2l1.4 1.4-14.6 13.6L5.6 14.8zm-1.4 0L1.2 10.4l1.4-1.4 2.6 2.6 5.8-5.8 1.4 1.4-7.2 7.2z"
                ></path>
              </svg>
            </template>
          </div>
          <template v-if="step !== totalSteps">
            <div class="flex-grow h-0.5 bg-black"></div>
          </template>
        </div>
      </template>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      currentStep: {
        type: Number,
        required: true
      },
      totalSteps: {
        type: Number,
        required: true
      }
    }
  };
  </script>
  
  <style>
  /* Add any additional styles here */
  </style>
  