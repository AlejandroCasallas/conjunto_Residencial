<!-- loader.php -->
<div id="loader">
  <div class="spinner"></div>
</div>

<style>
  #loader {
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .spinner {
    width: 50px;
    height: 50px;
    border: 6px solid #ccc;
    border-top-color: #333;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }

  .fade-out {
    opacity: 0;
    transition: opacity 0.5s ease;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let svgLoadDone = false;

  function replaceSVGs(callback) {
    const $imgs = jQuery('.icon img');
    let total = $imgs.length;
    let completed = 0;

    if (total === 0) {
      callback();
      return;
    }

    $imgs.each(function () {
      const $img = jQuery(this);
      const imgId = $img.attr('id');
      const imgClass = $img.attr('class');
      const imgUrl = $img.attr('src');
      const imgWidth = $img.attr('width');
      const imgHeight = $img.attr('height');

      jQuery.get(imgUrl, function (data) {
        let $svg = jQuery(data).find('svg');
        if ($svg.length > 0) {
          if (imgId) $svg.attr('id', imgId);
          if (imgClass) $svg.attr('class', imgClass + ' replaced-svg');
          if (imgWidth) $svg.attr('width', imgWidth);
          if (imgHeight) $svg.attr('height', imgHeight);
          $svg.removeAttr('xmlns:a');
          $svg.find('[fill]').attr('fill', 'currentColor');
          $img.replaceWith($svg);
        }
        completed++;
        if (completed === total) {
          callback();
        }
      }, 'xml');
    });
  }

  window.addEventListener('load', function () {
    replaceSVGs(function () {
      const loader = document.getElementById('loader');
      loader.classList.add('fade-out');
      setTimeout(() => loader.remove(), 500);
    });
  });
</script>