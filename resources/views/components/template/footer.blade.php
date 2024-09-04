<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">{{ env('APP_COPYRIGHT') }}</span>
        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> {{ sprintf("%s %s", env('APP_NAME'), env('APP_VERSION')) }} </span>
    </div>
</footer>