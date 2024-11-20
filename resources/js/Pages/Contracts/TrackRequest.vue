<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
</script>

<template>
  <DashboardLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Seguimiento de Solicitudes</h1>
            <div class="card">
              <div class="card-header">Estado Actual</div>
              <div class="card-body">
                <p><strong>Estado:</strong> Pendiente</p>
                <p><strong>Propiedad:</strong> Casa en Ciudad Jardín</p>
                <p><strong>Última Actualización:</strong> 2024-11-18</p>
              </div>
            </div>
            <div class="mt-3">
              <h2 class="text-xl font-semibold text-gray-800 mt-6">Historial de Notificaciones</h2>
              <ul class="list-group">
                <li
                  class="list-group-item"
                  v-for="notificacion in notificaciones"
                  :key="notificacion.id"
                >
                  <strong>{{ notificacion.titulo }}</strong> - {{ notificacion.mensaje }}
                  <span class="text-muted">({{ notificacion.fecha }})</span>
                  <div>
                    <small><strong>Propiedad asociada:</strong> {{ notificacion.propiedad }}</small>
                    <br />
                    <small><strong>Prioridad:</strong> {{ notificacion.prioridad }}</small>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script>
export default {
  data() {
    return {
      notificaciones: [
        {
          id: 1,
          titulo: "Notificación 1",
          mensaje: "Tu solicitud está en proceso.",
          fecha: "2024-11-18",
          propiedad: "Casa en Ciudad Jardín",
          prioridad: "Alta",
        },
        {
          id: 2,
          titulo: "Notificación 2",
          mensaje: "Tu solicitud ha sido aprobada.",
          fecha: "2024-11-19",
          propiedad: "Apartamento en Vista Real",
          prioridad: "Media",
        },
      ],
    };
  },
};
</script>

<style scoped>
.card {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-header {
  background-color: #f8f8f8;
  padding: 10px 15px;
  font-weight: bold;
  color: #555;
}

.card-body {
  padding: 15px;
  font-size: 0.9rem;
  color: #555;
}

.list-group-item {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  margin-bottom: 10px;
  padding: 10px 15px;
  background-color: #f9f9f9;
}

.text-muted {
  font-size: 0.8rem;
  color: #999;
}
</style>
