<template>
    <div class="skill-rating">
      <div 
        v-for="star in maxStars" 
        :key="star" 
        @click="setRating(star)" 
        
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2 text-gray-300" :class="{ 'text-yellow-500': star <= currentRating }">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
        </svg>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      maxStars: {
        type: Number,
        default: 5,
      },
      initialRating: {
        type: Number,
        default: 0,
      },
    },
    data() {
      return {
        currentRating: this.initialRating,
      };
    },
    methods: {
      setRating(rating) {
        this.currentRating = rating;
        this.$emit('rating-updated', rating);
      },
    },
  };
  </script>
  
  <style>
  .skill-rating {
    display: flex;
    align-items: center;
    gap: 5px;
  }
  
  .skill-rating i {
    font-size: 24px;
    cursor: pointer;
  }
  
  .skill-rating .selected {
    color: gold;
  }
  </style>
  