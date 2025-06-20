<script setup lang="ts">
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
})

const form = reactive({
    name: props.project.name,
    description: props.project.description,
    start_date: props.project.start_date,
    end_date: props.project.end_date,
    status: props.project.status,
    errors: {}
})

const submit = () => {
    router.put(`/projects/${props.project.id}`, form, {
        onError: (e) => {
            form.errors = e
        }
    })
}
</script>

<template>
    <AppLayout title="Editar Proyecto">
        <div class="max-w-4xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Editar Proyecto</h1>

            <form @submit.prevent="submit"
                class="space-y-10 flex flex-col items-center bg-white p-6 rounded shadow text-black">

                <div class="w-full">
                    <label class="block mb-1">Nombre</label>
                    <input v-model="form.name" type="text" class="w-full border p-2 rounded" />
                    <span class="text-red-500 text-sm">{{ form.errors.name }}</span>
                </div>

                <div class="w-full">
                    <label class="block mb-1">Descripción</label>
                    <textarea v-model="form.description" class="w-full border p-2 rounded"></textarea>
                    <span class="text-red-500 text-sm">{{ form.errors.description }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4 w-full">
                    <div>
                        <label class="block mb-1">Fecha de inicio</label>
                        <input v-model="form.start_date" type="date" class="w-full border p-2 rounded" />
                        <span class="text-red-500 text-sm">{{ form.errors.start_date }}</span>
                    </div>
                    <div>
                        <label class="block mb-1">Fecha de fin</label>
                        <input v-model="form.end_date" type="date" class="w-full border p-2 rounded" />
                        <span class="text-red-500 text-sm">{{ form.errors.end_date }}</span>
                    </div>
                </div>

                <div class="w-full">
                    <label class="block mb-1">Estado</label>
                    <select v-model="form.status" class="w-full border p-2 rounded">
                        <option value="Activo">Activo</option>
                        <option value="Pausado">Pausado</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                    <span class="text-red-500 text-sm">{{ form.errors.status }}</span>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar
                </button>
            </form>
        </div>
    </AppLayout>
</template>
