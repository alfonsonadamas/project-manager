<script setup lang="ts">
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
    project: Object,
    task: Object,
    users: Array,
})

const form = reactive({
    title: props.task.title,
    description: props.task.description,
    priority: props.task.priority,
    due_date: props.task.due_date,
    status: props.task.status,
    assigned_to: props.task.assigned_to,
    errors: {}
})

const submit = () => {
    router.put(`/projects/${props.project.id}/tasks/${props.task.id}`, form, {
        onSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: '¡Tarea actualizada!',
                text: 'La tarea se actualizó correctamente.',
            })
        },
        onError: (e) => {
            form.errors = e
        }
    })
}
</script>

<template>
    <AppLayout :title="`Editar Tarea - ${props.task.title}`">
        <div class="max-w-4xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Editar Tarea</h1>

            <form @submit.prevent="submit" class="space-y-6 bg-white p-6 rounded shadow text-black">

                <div>
                    <label class="block mb-1">Título</label>
                    <input v-model="form.title" type="text" class="w-full border p-2 rounded" />
                    <span class="text-red-500 text-sm">{{ form.errors.title }}</span>
                </div>

                <div>
                    <label class="block mb-1">Descripción</label>
                    <textarea v-model="form.description" class="w-full border p-2 rounded"></textarea>
                    <span class="text-red-500 text-sm">{{ form.errors.description }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Prioridad</label>
                        <select v-model="form.priority" class="w-full border p-2 rounded">
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                        <span class="text-red-500 text-sm">{{ form.errors.priority }}</span>
                    </div>

                    <div>
                        <label class="block mb-1">Fecha de entrega</label>
                        <input v-model="form.due_date" type="date" class="w-full border p-2 rounded" />
                        <span class="text-red-500 text-sm">{{ form.errors.due_date }}</span>
                    </div>
                </div>

                <div>
                    <label class="block mb-1">Asignar a</label>
                    <select v-model="form.assigned_to" class="w-full border p-2 rounded">
                        <option value="">-- Selecciona un usuario --</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                    <span class="text-red-500 text-sm">{{ form.errors.assigned_to }}</span>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar Tarea
                </button>
            </form>
        </div>
    </AppLayout>
</template>
