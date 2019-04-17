var CACHE_NAME = 'donorportal-cache-v1';
var urlsToCache = [
  '/donorportal/public/assets/css/bootstrap.min.css',
  '/donorportal/public/assets/css/core.css',
  '/donorportal/resources/views/index.blade.php',
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});
