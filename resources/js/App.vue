<script setup>
import { Link } from '@inertiajs/vue3'; // Import the Inertia Link component
</script>

<template>
  <div>
    <!-- Navigation Bar -->
    <nav>
      <Link href="/">Home</Link>
      <Link href="/about">About</Link>
      <Link href="/contact">Contact</Link>
    </nav>

    <!-- Page Content -->
    <main>
      <slot /> <!-- This is where Inertia will render your pages -->
    </main>

    <!-- Footer -->
    <footer>
      <p>&copy; 2023 Your App Name</p>
    </footer>
  </div>
</template>

<style>
/* Add some basic styling */
nav {
  background: #f3f4f6;
  padding: 1rem;
}

nav a {
  margin-right: 1rem;
  text-decoration: none;
  color: #4b5563;
}

nav a:hover {
  color: #000;
}

main {
  padding: 2rem;
}

footer {
  background: #f3f4f6;
  padding: 1rem;
  text-align: center;
}
</style>