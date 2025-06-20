<script setup lang="ts">
import { router, Link } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  projects: Array
})

const destroy = (id: number) => {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esta acción eliminará el proyecto permanentemente.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/projects/${id}`, {
        onSuccess: () => {
          Swal.fire('¡Eliminado!', 'El proyecto ha sido eliminado.', 'success')
        }
      })
    }
  })
}
</script>

<template>
  <AppLayout title="Proyectos">
    <div class="flex justify-between items-center mb-6 mx-10">
      <h1 class="text-2xl font-bold">Listado de Proyectos</h1>
      <a href="/projects/create" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
        + Nuevo Proyecto
      </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded mx-10">
      <table class="min-w-full table-auto text-left text-black">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Inicio</th>
            <th class="px-4 py-2">Fin</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id" class="border-b">
            <td class="px-4 py-2">{{ project.name }}</td>
            <td class="px-4 py-2">{{ project.start_date }}</td>
            <td class="px-4 py-2">{{ project.end_date }}</td>
            <td class="px-4 py-2">{{ project.status }}</td>
            <td class="px-4 py-2 space-x-2">
              <Link :href="`/projects/${project.id}/edit`" class="text-blue-600 hover:underline">
              Editar
              </Link>
              <button @click="destroy(project.id)" class="text-red-600 hover:underline">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
