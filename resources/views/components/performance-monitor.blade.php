@if(config('app.debug'))
<script>
    // Performance monitoring for development
    window.addEventListener('load', function() {
        // Measure page load time
        const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
        console.log('Page load time:', loadTime + 'ms');
        
        // Measure DOM content loaded time
        const domTime = performance.timing.domContentLoadedEventEnd - performance.timing.navigationStart;
        console.log('DOM content loaded time:', domTime + 'ms');
        
        // Measure first paint
        if (performance.getEntriesByType) {
            const paintEntries = performance.getEntriesByType('paint');
            paintEntries.forEach(entry => {
                console.log(entry.name + ':', entry.startTime + 'ms');
            });
        }
        
        // Monitor image loading
        const images = document.querySelectorAll('img');
        let loadedImages = 0;
        
        images.forEach(img => {
            if (img.complete) {
                loadedImages++;
            } else {
                img.addEventListener('load', () => {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        console.log('All images loaded');
                    }
                });
            }
        });
    });
</script>
@endif
