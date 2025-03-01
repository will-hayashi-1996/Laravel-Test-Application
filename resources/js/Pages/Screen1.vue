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

  const searchTerm = reactive({data: null});

  const ResultUsersApi = reactive({data: null});

  function search() {
    axios.get(route('test.get',{search:searchTerm.data}))
      .then(response => {
        console.log(response.data)
        ResultUsersApi.data = response.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  let timeout = null

  const handleKeyup = () => {
    clearTimeout(timeout) // Clear previous timeout
    timeout = setTimeout(() => {
      search()
    }, 300) // 300ms delay
}

  onMounted(()=>{
    axios.get(route('users.get'))
      .then(response => {
        ResultUsersApi.data=response.data.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  })

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

          <div class="flex">
            <label for="search" class="block text-sm font-medium text-gray-700 mx-2 my-3">Search:</label>
            <input 
              type="text" 
              id="search" 
              @keyup="handleKeyup" 
              v-model="searchTerm.data"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
            
          </div>

      </div>

      <hr class="my-2">

      <table class="min-w-full border border-gray-300 shadow-md rounded-lg">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
            <th class="px-4 py-2 border border-gray-300 text-left">Name</th>
            <th class="px-4 py-2 border border-gray-300 text-left">E-mail</th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="user in ResultUsersApi.data" 
            :key="user?.id" 
            class="border border-gray-300 odd:bg-white even:bg-gray-50 hover:bg-gray-200 transition-colors"
          >
            <td class="px-4 py-2 border">{{ user?.id }}</td>
            <td class="px-4 py-2 border">{{ user?.name }}</td>
            <td class="px-4 py-2 border">{{ user?.email }}</td>
          </tr>
        </tbody>
      </table>


    </div>

  </div>
</template>
  