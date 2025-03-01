<script setup>
  import { ref, onMounted, reactive } from 'vue';
  import axios from 'axios';
  import { route } from 'ziggy-js';
  import { useForm } from '@inertiajs/vue3';
  

  const form = useForm({
    name: '',
    email: '',
  });
  
  // Function to handle form submission
  function submit() {
    form.post(route('test.post'), {
      onSuccess: () => {
        alert('Form submitted successfully!');
        form.reset(); // Reset the form after successful submission
      },
      onError: (errors) => {
        console.error('Form errors:', errors);
      },
    });
  }
  
  const searchId = reactive({data: null});

  const searchUser = reactive({data: null});

  function search() {
    axios.get(route('test.get',{search:searchId.data}))
      .then(response => {
        searchUser.data = response.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

 

  </script>

<template>
  <div class="flex min-h-screen">
  
    <div class="w-64 bg-gray-800 text-white fixed h-full">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Sidebar</h2>
        <ul class="mt-4">
          <li class="mb-2">
            <a :href="route('render.screen1')" class="block p-2 hover:bg-gray-700 rounded">Screen 1</a>
          </li>
          <li class="mb-2">
            <a :href="route('render.screen2')" class="block p-2 hover:bg-gray-700 rounded">Screen 2</a>
          </li>
          <li class="mb-2">
            <a :href="route('render.screen3')" class="block p-2 hover:bg-gray-700 rounded">Screen 3</a>
          </li>
        </ul>
      </div>
    </div>

    
    <div class="flex-1 ml-64 p-6">

      <div class="max-w-md mx-auto">

        This is Screen 2

      </div>
    </div>

  </div>
</template>
  