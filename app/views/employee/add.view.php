
<div class="wrapper">
    <div class="empform">
        <form class="appform" method="post" enctype="application/x-www-form-urlencoded">
            <fieldset>
                <legend>employees informtion</legend>
                <?php if(isset( $_SESSION['message'])) { ?>

                    <P class="message <?= isset($error) ? 'error' : ' '  ?> "> <?=   $_SESSION['message']  ?> </P>

                    <?php
                    unset($_SESSION['message']);
                } ?>
                <table class="data">
                    <tr>
                        <td>
                            <label for="name">employee name</label>
                        </td>
                    </tr>

                    <tr>
                        <td>

                            <input  type="text"  required name="name"  id="name"  placeholder="writer the employee" maxlength="50" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="age">employee age</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" required name="age" id="age"   min="22" max="60"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="address">employee address</label>
                        </td>
                    </tr>

                    <tr>
                        <td>

                            <input  type="text"  required name="address"  id="address"  placeholder="writer the employee address"  maxlength="50" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="salary">employee salary</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" required name="salary"  id="salary"  step="0.01"  min="3000" max="6000"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="tax">employee tax %</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="number" required name="tax" id="tax" step="0.01"  min="1" max="2"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit"  name="submit" value="save" />
                        </td>
                    </tr>


                </table>
            </fieldset>
        </form>
    </div>


</div>
