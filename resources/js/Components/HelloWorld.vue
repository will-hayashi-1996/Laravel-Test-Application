<template>
    <div>
      <h1>Hello from Vue in Laravel!</h1>
      <p>Counter: {{ count }}</p>
      <button @click="increment">Increase Counter</button>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  // Create a reactive counter variable
  const count = ref(0);
  
  // Function to increment the counter
  function increment() {
    count.value++;
  }
  </script>
  
  <style>
  /* Optional: Add some basic styling */
  button {
    padding: 0.5rem 1rem;
    background-color: #3490dc;
    color: white;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #2779bd;
  }
  </style>