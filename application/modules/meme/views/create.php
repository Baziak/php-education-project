<div class="col-md-12" id="page">
    <div class="col-md-12 row" id="images">
        <?php  echo html_entity_decode($this->images);?>
    </div>
    <div id="create">
        <div class="row">
            <div class="col-md-8" id="main">
                <span class="aligner"></span>
                <img src="#" alt="selected">

            </div>
            <div class="col-md-4" id="inputs">
                <input type="text" id="name" value="Название мема" class="initial"><br />
                <?php  echo html_entity_decode($this->inputs);?>
            </div>
        </div>
        <div class="col-md-12" id="submit">
            <input type="button" value="Создать мем">
        </div>
    </div>
</div>
<img src="/public/images/ajax.gif" alt="ajax" id="ajax">