<?php
/*
    Plugin Name: NDL Access
    Description: Plugin qui permet d'ajouter un menu de gestion d'accès dans le menu admin des utilisateurs
    Author: Thomas De Maen
    Version: 1.0
*/

function ndl_usermeta_form_access($user){
    if (current_user_can('manage_options')) {
        ?>
        <h3>Gestion des accès</h3>
        <table class="form-table">
            <tr>
                <th>
                    <label for="classes">Classes</label>
                </th>
                <td>
                    <p class="description">
                        Gérez les accès des parents et des profs : si une classe est cochée, le parent ou le prof peut avoir accès aux éléments privés de la classe.
                        Cette dernière apparaîtra dans la liste de ses classes dans le menu "Mon Espace Classe".
                    </p>
                    <ul>
                        <?php 
                            foreach(get_categories(['hide_empty' => 0]) as $classe){
                                $name = $classe->name;
                                $slug = $classe->slug;
                                $checked = "";
                                $meta = get_user_meta($user->ID, 'access')[0];

                                if ($meta && in_array($slug, $meta))
                                    $checked = "checked";

                                if ($slug != "uncategorized") {
                                    echo "<li><input type='checkbox' id='$slug' name='access[]' value='$slug' style='margin-right:10px;' $checked>";
                                    echo "<label for='$slug' style='line-height:2em;'>$name</label></li>";
                                }
                            }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <?php
    }
}
// On ajoute le champ au menu d'édition des profils
add_action('edit_user_profile', 'ndl_usermeta_form_access');

// On ajoute le champ au menu d'édition du profil perso
add_action('show_user_profile', 'ndl_usermeta_form_access');

function ndl_usermeta_access_update($user_id){
    if (!current_user_can('edit_user', $user_id) && !current_user_can('manage_options')){
        return false;
    }

    // Mets à jour ou créer une nouvelle méta "access"
    return update_user_meta(
        $user_id,
        'access',
        $_POST["access"]
    );
}
// Ajoute la fonction de sauvegarde sur les profils
add_action('personal_options_update','ndl_usermeta_access_update');
 
// Ajoute la fonction de sauvegarde sur le profil perso
add_action('edit_user_profile_update','ndl_usermeta_access_update');