<!-- Modal -->
<div class="modal fade" id="patient-additional-info" tabindex="-1" role="dialog"
    aria-labelledby="patient-additional-info-title" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patient-additional-info-title">დამატებითი ინფორმაცია</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="დახურვა">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="patient-additional-form">
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="patient-state">რეგიონი</label>
                            <select class="form-control" name="patient-state" id="patient-state">
                                <option value="">აირჩიეთ</option>
                                <option value="imereti">იმერეთი</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="patient-region">რაიონი</label>
                            <select class="form-control" name="patient-region" id="patient-region">
                                <option value="">აირჩიეთ</option>
                                <option value="zestaphoni">ზესტაფონი</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="patient-city">ქალაქი</label>
                            <select class="form-control" name="patient-city" id="patient-city">
                                <option value="">აირჩიეთ</option>
                                <option value="zestaphoni">ზესტაფონი</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="patient-physical-adress">ფაქტიური მისამართი</label>
                            <input type="text" data-geokb="true" name="patient-physical-adress" class="form-control" id="patient-physical-adress" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="patient-relationship-status">ოჯახური მდგომარეობა</label>
                            <select class="form-control" name="patient-relationship-status" id="patient-relationship-status">
                                <option value="">აირჩიეთ</option>
                                <option value="single">დასაოჯახებელი</option>
                                <option value="inrelationship">დაოჯახებული</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="patient-relative">ნათესავი</label>
                            <input type="text" data-geokb="true" class="form-control" name="patient-relative" id="patient-relative" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="patient-education">განათლება</label>
                            <select class="form-control" name="patient-education" id="patient-education">
                                <option value="">აირჩიეთ</option>
                                <option value="bachelor">უმაღლესი</option>
                                <option value="highschool">საშუალო</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="patient-work-status">დასაქმება</label>
                            <select class="form-control" name="patient-work-status" id="patient-work-status">
                                <option value="">აირჩიეთ</option>
                                <option value="unemployed">უმუშევარი</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="patient-operator-note">შენიშვნა / კომენტარი</label>
                            <textarea class="form-control" data-geokb="true" name="patient-operator-note" id="patient-operator-note" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="dissmis-patient-add-info" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
                <button type="button" id="save-patient-add-info" class="btn btn-info">შენახვა</button>
            </div>
        </div>
    </div>
</div>