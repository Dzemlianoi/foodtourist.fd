<div class="container specials col-md-10">
    <div class="row title">
        <h3 class="col-md-3">Популярные товары</h3>
        <div class="col-md-9">
            <div class="special-line">
            </div>
        </div>
    </div>
    <div class="row content-special">
        <?php echo push_hots_or_newings(HOTS_SHOW, 'sale-sprite') ?>
    </div>
</div>
<div class="container specials col-md-10">
    <div class="row title">
        <h3 class="col-md-3">Новые товары</h3>
        <div class="col-md-9">
            <div class="special-line">
            </div>
        </div>
    </div>
    <div class="row content-special">
        <?php echo push_hots_or_newings(NEWINGS_SHOW,'new-sprite') ?>
    </div>
</div>