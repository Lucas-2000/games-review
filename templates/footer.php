<div class="footer">
  <p>Games Review &copy; 2023</p>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
  const reviewInput = document.getElementById('review');

  const charCount = document.getElementById('charCount');

  reviewInput.addEventListener('input', () => {
    const inputValue = reviewInput.value;

    const charLength = inputValue.length;

    charCount.textContent = charLength;
  });

</script>

</html>