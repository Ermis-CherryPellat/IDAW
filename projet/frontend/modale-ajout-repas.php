<form id="addRepasForm" onsubmit="onFormSubmit();">
    <div class="row rowAliment">
        <div class="col-lg-3">
            <label for="datetime">Date et heure du repas</label>
            <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
        </div>
        <div class="col-lg-3">
            <label for="mealType">Type de repas</label>
            <select class="form-control" id="typeRepas" name="typeRepas" required>
            </select>
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-success bouton_form">Enregistrer le repas</button>
        </div>
    </div>
    
    <div class="form-group">
        <label for="alimentChoisi" class="card-title">Aliments du repas</label>
            <p>Choisissez dans le tableau au moins un aliment de votre repas.</p>
            <div id="alimentsChoisis">
            </div>
    </div>

    <table id="alimentsTable" class="display">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Glucides</th>
                        <th>Lipides</th>
                        <th>Sucres</th>
                        <th>Protéines</th>
                        <th>Fibres</th>
                        <th>Énergie</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
   
</form>