# Banner Image Specifications 📐

## Exact Dimensions Required ⚠️ IMPORTANT

### **MUST BE WIDE (Landscape):**
- **Width:** 1920 pixels (or wider - 2400px, 3000px)
- **Height:** 400 pixels (FIXED - do not change)
- **Aspect Ratio:** 4.8:1 or wider (WIDE horizontal banner)
- **CRITICAL:** Image MUST be WIDER than it is TALL (landscape orientation)

### **Why These Dimensions?**
- Banner height: 400px
- Padding: 22px on all sides
- Image display area: Full width × 400px height
- Standard desktop width: 1920px

---

## Image Requirements

### **Format:**
- **File Type:** PNG or JPG
- **PNG** (recommended) - Better quality, supports transparency
- **JPG** - Smaller file size, good for photos

### **Dimensions:**
```
Width: 1920px
Height: 400px
Aspect Ratio: 4.8:1 (wide horizontal banner)
```

### **File Size:**
- Recommended: Under 500KB (for fast loading)
- Maximum: 1MB (to ensure good performance)

---

## What to Include in the Image

### **Content Suggestions:**
1. **Dog with basket** (main focus)
2. **Product bars** (Basket Bars)
3. **Himalayan theme** (mountains, natural elements)
4. **Brand name/text** (if you want it in the image itself)
5. **Warm, earthy colors** (browns, tans, golds)

### **Layout Tips:**
- Keep important content in the **center** of the image
- Avoid placing important elements too close to edges (may get cropped on smaller screens)
- Use **horizontal/landscape orientation** (wide, not tall)

---

## How to Create the Image

### **Option 1: ChatGPT/DALL-E**
Ask ChatGPT:
```
"Create a horizontal banner image for an e-commerce website. 
Dimensions: 1920 pixels wide × 400 pixels tall.
Show a friendly dog carrying a basket with Himalayan Basket Bars products.
Include mountains in the background.
Use warm, earthy colors (browns, tans, golds).
Style: Illustrative, natural, rustic.
Make it suitable for a product banner/slider."
```

### **Option 2: Image Editing Software**
- Use Photoshop, GIMP, Canva, or similar
- Create new image: 1920px × 400px
- Design your banner
- Export as PNG or JPG

---

## After Creating the Image

1. **Save the image** as: `banner1.png` (or `banner1.jpg`)
2. **Place it in:** `public/images/` folder
3. **Update the slider** in `homepage.blade.php`:
   ```blade
   <div class="slide">
       <img src="{{ asset('images/banner1.png') }}" alt="Banner 1" class="hero-image">
   </div>
   ```

---

## Current Banner Settings

- **Banner Height:** 400px
- **Padding:** 22px (all sides)
- **Display Mode:** Cover (fills entire space)
- **Responsive:** Scales on mobile devices

---

## Quick Summary

**Perfect Banner Image:**
- ✅ 1920px wide
- ✅ 400px tall  
- ✅ Horizontal/landscape orientation
- ✅ PNG or JPG format
- ✅ Under 500KB file size
- ✅ Important content centered
- ✅ Warm, natural colors

**This will fit perfectly!** 🎯

