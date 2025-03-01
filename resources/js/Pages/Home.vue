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

      <p class="flex justify-center my-3">Register a User</p>

      <div class="max-w-md mx-auto">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input 
              type="text" 
              id="name" 
              v-model="form.name"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input 
              type="email" 
              id="email" 
              v-model="form.email"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
            <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
          </div>

          <button 
            type="submit" 
            :disabled="form.processing"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
          >
            {{ form.processing ? 'Submitting...' : 'Submit' }}
          </button>
        </form>

        <div  class="space-y-6 my-6">
          <label for="id" class="block text-sm font-medium text-gray-700">Search a User:</label>
            <input 
              type="text" 
              id="id" 
              v-model="searchId.data"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
          <button 
              type="submit" 
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600
              hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
              @click="search()"
            >
              Search User (Can be Either id or name)
            </button>

            <div v-if="searchUser.data">

              The user you searched is:

              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input 
                  type="text" 
                  id="name" 
                  v-model="searchUser.data.name"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input 
                  type="email" 
                  id="email" 
                  v-model="searchUser.data.email"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />

              </div>

            </div>
          </div>

        
      </div>
    </div>
  </div>
</template>
  