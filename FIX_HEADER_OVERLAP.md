# Fix: Header Overlapping Cart Sidepanel

## Problem
When the user scrolled and the navbar became sticky (fixed position), opening the cart sidepanel caused the header to overlap the sidepanel content. The issue was that both elements had high z-index values, and the header's fixed positioning caused it to appear above the sidepanel.

## Root Cause
- The header uses `position: fixed` or `position: sticky` when scrolling
- The header has a high z-index (`z-index: 10000`)
- The cart sidepanel also has a high z-index (`z-index: 9999`)
- When both are active, the header overlaps the sidepanel

## Solution Implemented
The solution hides the header when the cart sidepanel is open, providing a cleaner user experience without z-index conflicts.

### Changes Made

#### 1. CSS Changes (`css/cart-sidepanel.css`)
Added styles to hide the header when the cart is open:

```css
/* Hide header when cart sidepanel is open */
body.cart-open header,
body.cart-open #main-header {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
```

#### 2. JavaScript Changes (`js/cart-sidepanel.js`)

**In the `open()` method:**
- Added code to explicitly hide the header with smooth transition
- Sets `opacity: 0` and `visibility: hidden` on the header element

```javascript
// Hide header to prevent overlap
const header = document.querySelector('#main-header') || document.querySelector('header');
if (header) {
    header.style.opacity = '0';
    header.style.visibility = 'hidden';
    header.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
}
```

**In the `close()` method:**
- Added code to restore the header visibility
- Resets the inline styles to allow normal header behavior

```javascript
// Show header again
const header = document.querySelector('#main-header') || document.querySelector('header');
if (header) {
    header.style.opacity = '';
    header.style.visibility = '';
}
```

## Benefits of This Approach

1. **Clean UX**: No visual conflicts between header and sidepanel
2. **Smooth Transitions**: The header fades out/in smoothly when the cart opens/closes
3. **No z-index Wars**: Avoids complicated z-index stacking contexts
4. **Focus on Cart**: Users can focus entirely on their cart without header distractions
5. **Responsive**: Works across all screen sizes
6. **Accessibility**: Maintains proper focus management

## Testing Checklist

- [x] Header hides when cart sidepanel opens
- [x] Header reappears when cart sidepanel closes
- [x] Smooth fade transition (0.3s)
- [x] Works on desktop
- [x] Works on mobile
- [x] No console errors
- [x] Proper focus management maintained

## Alternative Solutions Considered

1. **Increase sidepanel z-index**: Would require increasing it above 10000, which could cause issues with other overlays
2. **Decrease header z-index when cart is open**: More complex CSS management
3. **Remove header fixed positioning**: Would break the sticky header functionality

The chosen solution of hiding the header is the cleanest and most maintainable approach.

## Files Modified

- `css/cart-sidepanel.css` - Added header hiding CSS rules
- `js/cart-sidepanel.js` - Added header show/hide logic in open() and close() methods

## Maintenance Notes

- The header is identified by the selector `#main-header` or `header`
- If the header element ID changes in the future, update the JavaScript selectors
- The transition duration is 0.3s, matching the cart sidepanel animation
