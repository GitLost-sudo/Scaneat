// Vérifie que le navigateur supporte les notifications + SW
if ('serviceWorker' in navigator && 'Notification' in window) {
  navigator.serviceWorker.register('../sw.js')
    .then(reg => {
      console.log('Service Worker enregistré');
      Notification.requestPermission().then(permission => {
        if (permission === "granted") {
          verifierProduitsBientotPerimes();
        }
      });
    })
    .catch(err => {
      console.error('Erreur SW :', err);
    });
}

function subscribeUser() {
  Notification.requestPermission().then(permission => {
    if (permission === "granted") {
      navigator.serviceWorker.ready.then(registration => {
        registration.showNotification("🎉 Notification activée !", {
          body: "Vous recevrez des messages de notre site.",
          icon: "https://via.placeholder.com/128",
          vibrate: [200, 100, 200],
          tag: "demo-notif"
        });
      });
    } else {
      alert("Notifications refusées ou non supportées.");
    }
  });
}

// Fonction pour notifier les produits bientôt périmés
function verifierProduitsBientotPerimes() {
  fetch('/scaneat/controllers/notification_controller.php')
    .then(response => response.json())
    .then(produits => {
      produits.forEach(produit => {
        console.log('Produits à notifier:', produits); // Ajoute ce log
        notifierPeremption(produit.nom, produit.diff_jours, produit.date_peremption);
      });
    });
}

function notifierPeremption(nom, diffJours, datePeremption) {
  console.log('Notification demandée pour:', nom, diffJours, datePeremption); // Ajoute ce log
  if (Notification.permission === "granted") {
    navigator.serviceWorker.ready.then(registration => {
      registration.showNotification("⚠️ Produit bientôt périmé", {
        body: `${nom} expire dans ${diffJours} jour(s) (${datePeremption})`,
        icon: "https://via.placeholder.com/128",
        vibrate: [200, 100, 200],
        tag: `peremption-${nom}`
      });
    });
  }
}