<footer class="footer bg-white py-3 mt-5 border-top">
    <div class="container-fluid text-center">
        <p class="text-muted mb-0">
            Copyright &copy; <span id="year"></span> EVENT KMEANS
        </p>
    </div>
</footer>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('year').textContent = new Date().getFullYear();
        });
    </script>
@endpush
