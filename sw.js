// Ce fichier est requis même pour une notification locale
self.addEventListener('install', event => {
  console.log('SW installé');
});

self.addEventListener('activate', event => {
  console.log('SW activé');
});

self.addEventListener('notificationclick', event => {
  event.notification.close();
  event.waitUntil(
    clients.openWindow('/scaneat/controllers/frigo_controller.php') // redirige vers le site
  );
});
