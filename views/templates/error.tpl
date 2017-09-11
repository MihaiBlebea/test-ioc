
{extends file='misc_layout.tpl'}

{block name="body"}
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {$error}
                    {if $error !== false}
                        <div class="col-md-8 col-sm-12">
                            <h4 class="card-title">404 - Un cod ciudat</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Nu intra in panica,asta inseamna doar ca pagina pe care o cauti nu exista</h6>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <a href="{$app_path}/select"><button type="button" class="btn btn-primary btn-lg">Vreau sa ajung acasa</button></a>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
{/block}

{block name="footer"}

{/block}
