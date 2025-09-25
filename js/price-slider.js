// Price Range Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
    const minSlider = document.getElementById('min-price-slider');
    const maxSlider = document.getElementById('max-price-slider');
    const minDisplay = document.getElementById('min-price-display');
    const maxDisplay = document.getElementById('max-price-display');
    const minInput = document.getElementById('min_price');
    const maxInput = document.getElementById('max_price');
    const sliderRange = document.getElementById('price-slider-range');
    const applyButton = document.getElementById('apply-price-filter');

    if (!minSlider || !maxSlider) return;

    const minValue = parseInt(minSlider.min);
    const maxValue = parseInt(minSlider.max);

    // Update slider range visual
    function updateSliderRange() {
        const minPercent = ((minSlider.value - minValue) / (maxValue - minValue)) * 100;
        const maxPercent = ((maxSlider.value - minValue) / (maxValue - minValue)) * 100;
        
        sliderRange.style.left = minPercent + '%';
        sliderRange.style.width = (maxPercent - minPercent) + '%';
    }

    // Update displays and hidden inputs
    function updateValues() {
        let minVal = parseInt(minSlider.value);
        let maxVal = parseInt(maxSlider.value);

        // Ensure min is not greater than max
        if (minVal >= maxVal) {
            if (minSlider === document.activeElement) {
                maxVal = minVal + 1;
                maxSlider.value = maxVal;
            } else {
                minVal = maxVal - 1;
                minSlider.value = minVal;
            }
        }

        // Update displays
        minDisplay.textContent = new Intl.NumberFormat().format(minVal);
        maxDisplay.textContent = new Intl.NumberFormat().format(maxVal);

        // Update hidden inputs
        minInput.value = minVal;
        maxInput.value = maxVal;

        // Update visual range
        updateSliderRange();
    }

    // Event listeners for sliders
    minSlider.addEventListener('input', updateValues);
    maxSlider.addEventListener('input', updateValues);

    // Apply filter button
    if (applyButton) {
        applyButton.addEventListener('click', function() {
            const currentUrl = new URL(window.location);
            const minPrice = minInput.value;
            const maxPrice = maxInput.value;

            // Update URL parameters
            if (minPrice && minPrice > minValue) {
                currentUrl.searchParams.set('min_price', minPrice);
            } else {
                currentUrl.searchParams.delete('min_price');
            }

            if (maxPrice && maxPrice < maxValue) {
                currentUrl.searchParams.set('max_price', maxPrice);
            } else {
                currentUrl.searchParams.delete('max_price');
            }

            // Reset to first page when filtering
            currentUrl.searchParams.delete('paged');

            // Redirect to filtered URL
            window.location.href = currentUrl.toString();
        });
    }

    // Initialize slider range on page load
    updateSliderRange();

    // Add CSS for slider styling
    const style = document.createElement('style');
    style.textContent = `
        .price-slider-input {
            pointer-events: none;
        }
        
        .price-slider-input::-webkit-slider-thumb {
            appearance: none;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #3b82f6;
            cursor: pointer;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            pointer-events: all;
            position: relative;
            z-index: 2;
        }
        
        .price-slider-input::-webkit-slider-thumb:hover {
            background: #2563eb;
            transform: scale(1.1);
        }
        
        .price-slider-input::-moz-range-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #3b82f6;
            cursor: pointer;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            pointer-events: all;
        }
        
        .price-slider-input::-moz-range-thumb:hover {
            background: #2563eb;
            transform: scale(1.1);
        }
        
        .price-slider-input:focus::-webkit-slider-thumb {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
        
        .price-slider-input:focus::-moz-range-thumb {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
        
        .price-slider-track {
            position: relative;
        }
        
        #price-slider-range {
            transition: all 0.1s ease;
        }
    `;
    document.head.appendChild(style);
});