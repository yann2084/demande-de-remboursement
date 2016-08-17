<?php 

include("configPAGORAodm.php");


function droits($sqlserveur,$sqluti,$sqlmdp,$sqlbd,$email,$prenom,$nom) {
				
	//Connexion à la base
	$lien = mysql_connect($sqlserveur,$sqluti,$sqlmdp);
	if (empty($lien)) {erreur_interne('Erreur '.mysql_error(),__FILE__,__LINE__);}
	$select = mysql_select_db($sqlbd, $lien);
	if (empty($select)) {erreur_interne('Erreur. ' . mysql_error(),__FILE__,__LINE__);}	
					
	// On affiche la liste des responsables contenues dans la table responsable
	$query = "select prn_res, nom_res, droit_res from `resp_odm` WHERE ((prn_res ='$prenom') AND (nom_res ='$nom'))";  
	$result = mysql_query($query, $lien);
	if (empty($result))  {erreur_interne('Erreur. '.mysql_error(),__FILE__,__LINE__); }
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		if ($tab = mysql_fetch_array($result)) {
			$droit=$tab['droit_res'];
			session_start();
			$_SESSION['prenom_user'] = $prenom;
			$_SESSION['nom_user'] = $nom;
			$_SESSION['droit'] = $droit;
			header("Location: controler/accueil.ctrl.php?prenom=$prenom&nom=$nom&droit=$droit&email=$email&ident=$Ident");
		}
	}
	else {
					
		// On affiche la liste des salariés contenues dans la table salarie
		$query = "select prn_sal, nom_sal from `salarie_odm` WHERE ((prn_sal ='$prenom') AND (nom_sal ='$nom'))";  	
		$result = mysql_query($query, $lien);
		if (empty($result))  {erreur_interne('Erreur. '.mysql_error(),__FILE__,__LINE__); }
		$numrows = mysql_num_rows($result);
		if ($numrows > 0) {
			if ($tab = mysql_fetch_array($result)) {
				$droit="Utl";
				session_start();
				$_SESSION['prenom_user'] = $prenom;
				$_SESSION['nom_user'] = $nom;
				$_SESSION['droit'] = $droit;
				header("Location: controler/accueil.ctrl.php?prenom=$prenom&nom=$nom&droit=$droit&email=$email&ident=$Ident");
			}
		}
		else echo "Votre $prenom $nom n'exite pas dans la liste des utilisateur<br> Veuillez contacter l'administrateur.";		
						
	}
			
	mysql_close($lien);
	exit;
}
 

	
echo "<!-- Gestion des jours de congé pour le personnel --> 
<html><head> 
<meta name=\"AUTHOR\" content=\"projet conge - PAGORA - Grenoble\"> 
<meta name=\"KEYWORDS\" content =\"gestion jour de conge\">
<meta name=\"DESCRIPTION\" content=\" estion des jours de congé pour le personnel. \">
<meta http-equiv=\"Content-Language\" content=\"fr\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<title> \"Gestion jours de congé\" </title>
<LINK href=\"style.css\" rel=\"stylesheet\" type=\"text/css\">
</head>";

echo "<script Language=\"JavaScript\">
function Validation_saisie(theForm)
{
	if (theForm.Ident.value == \"\")
	{
        alert(\"Entrez une valeur pour le champ Identifiant.\");
		theForm.Ident.focus();
        return (false);
    }
	if (theForm.Mdp.value == \"\")
	{
        alert(\"Entrez une valeur pour le champ Mot de passe.\");
		theForm.Mdp.focus();
        return (false);
    }
}
</script>";

echo "<BODY BGCOLOR=\"#FFFFFF\" TEXT=\"#000000\">";

	//récupération des variables
	if (empty($_POST['Ident'])) $Ident="";
	else $Ident=$_POST['Ident'];
	if (empty($_POST['Mdp'])) $Mdp="";
	else $Mdp=$_POST['Mdp'];
	//var_dump($_POST);
	
	
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
	<tr>
        <td WIDTH=\"15%\">&nbsp;</td>
		<td>
			<table CELLPADDING=0 CELLSPACING=0 BORDER=0 width=100%>
				<tr>
					<td align=center><img border=\"0\" src=\"images/pagora.jpg\"><br></TD>
					<td align=center><img border=\"0\" src=\"images/AGEFPI.jpg\"><br></TD>
					<td align=center><img border=\"0\" src=\"images/LGP2.jpg\"><br></TD>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td WIDTH=\"15%\">&nbsp;</td>
        <TD>
            <BR><BR>
            <FONT SIZE=5>Bienvenue dans l'application [-Retour de mission -> Demande de remboursement] de Pagora.</FONT>
            <BR><BR>      		
        </td>
    </tr>
	<tr>
		<td WIDTH=\"15%\">&nbsp;</td>
		<td>";

			
			
			
		if ((!empty($Ident)) && (!empty($Mdp))) {
			//$ldapServer = "pole-ldap.ampere.inpg.fr";
			//$ldapServer = "papet-ad1.papet.efpg.inpg.fr";
			$ldapServer = "147.171.72.193";
			
			$ldapServerPort = 389;
	
			//echo "Connexion au serveur <br />";
			$conn=ldap_connect($ldapServer);

			// on teste : le serveur LDAP est-il trouve ?
			if (!$conn)
				die("connexion impossible au serveur LDAP");
	
			// On dit qu'on utilise LDAP V3, sinon la V2 par dÃ©faut est utilisÃ©
			// et le bind ne passe pas.
			if (!ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
				echo "Impossible d'utiliser LDAP V3\n";
				exit;  
			}
	
			//$mdp="Aqlsiesa5";
			$mdp="PRO38tec";
			
			//$dn = 'cn=pam-pagora,ou=UA,dc=inpg,dc=fr';
			$dn = 'cn=vernetty,ou=TEMPORAIRES,OU=divers,OU=People,dc=papet,dc=efpg,dc=inpg,dc=fr';
			
			$bindServerLDAP=ldap_bind($conn,$dn,$mdp);
			// print ("Liaison au serveur : ". ldap_error($conn)."\n");
			// en cas de succÃ¨s de la liaison, renvoie Vrai
			echo "ldap_bind = "; var_dump($bindServerLDAP);
			if (!$bindServerLDAP)
				die("Liaison impossible au serveur ldap". ldap_error($conn)." !");
	

			// Interrogation de l'annuaire
			//$basequery = "o=pagora,ou=aliases,ou=ampere-berges,dc=inpg,dc=fr";
			//$basequery = "ou=users,ou=ampere-berges,dc=inpg,dc=fr";
			$basequery = "OU=People,DC=papet,DC=efpg,DC=inpg,DC=fr";

			$recherche=ldap_search($conn,$basequery,"uid=".$Ident);
			echo "recherche = "; var_dump($recherche);
			
			$info = ldap_get_entries($conn,$recherche);
			echo "info = "; var_dump($info);
			if ($info["count"]>0) {
				$email=$info[0]['mail'][0];
				$tableau = explode('@', $email);
				$prenomnom=$tableau[0];
				$tableau2 = explode('.', $prenomnom);
				$prenom=$tableau2[0];
				$nom=$tableau2[1];
				$pos = strpos($email, "pagora");
				if ($pos === false) {
					$pos = strpos($email, "lgp2");
					if ($pos === false)
						echo "l'adresse mail doit être soit pagora.grenoble-inp.fr, soit lgp2.grenoble-inp.fr";
					else {
						$dn = "uid=".$Ident.", ou=users,ou=lgp2,dc=inpg,dc=fr";
						$bindServerLDAP=@ldap_bind($conn,$dn,$Mdp);
						if (!$bindServerLDAP)
							echo "<center><SPAN STYLE='font-size: 14px; background: #DE6661:;; color:white;'>Mot de passe incorrect</SPAN></center><br>";
						else {
						$bidon=droits($sqlserveur,$sqluti,$sqlmdp,$sqlbd,$email,$prenom,$nom);
						//header("Location: accueil.php?prenom=$prenom&nom=$nom&droit=$s_droit&email=$email");
						}
					}
				}
				else {
					$dn = "uid=".$Ident.", ou=users,ou=pagora,dc=inpg,dc=fr";
					$bindServerLDAP=@ldap_bind($conn,$dn,$Mdp);
					if (!$bindServerLDAP)
						echo "<center><SPAN STYLE='font-size: 14px; background: #DE6661; color:white;'>Mot de passe incorrect</SPAN></center><br>";
					else $bidon=droits($sqlserveur,$sqluti,$sqlmdp,$sqlbd,$email,$prenom,$nom);
				}
			}
			else {
				echo "<center><SPAN STYLE='font-size: 14px; background: #DE6661; color:white;'>Identifiant incorrect ou mot de passe erroné</SPAN></center><br>";
			}
			
			ldap_close($conn);
		

		}
		

?>
		</td>
	</tr>
	<tr>
		<td WIDTH="15%">&nbsp;</td>
		<td width=80% align="left" valign="middle" >
			<TABLE border=0 cellPadding=0 cellSpacing=0 width =100% bgcolor="#d6e6f6">
				<FORM action="index.php" onsubmit="return Validation_saisie(this)" method="post" name="identification">
					<TR>
						<TD colspan=2 align=center><br><font size="4" color="blue"><b> Identification</b></font><br><br></TD>
					</TR>
					<TR>
						<TD width=25%>Identifiant (compte Agalan) :</TD>
						<TD><INPUT name="Ident" size=20 style="WIDTH: 300px" value=""></TD>
					</TR>
					<TR>
						<TD width=25%><br>Mot de passe :</TD>
						<TD><br><INPUT name="Mdp" size=20 style="WIDTH: 300px" type=password></TD>
					</TR>
					<TR>
						<TD colspan=2 align=center><br><INPUT alt=OK border=0 height=20 src="images/ok.gif" type=image width=36>&nbsp;&nbsp;</TD>  
					</TR>
				</FORM>
			</TABLE>                                                                                                                                           
		</td>
	</tr>
	<tr>
		<td WIDTH="15%">&nbsp;</td>
        <TD>
            <BR><BR>
            En cas de problème <a href="mailto:Mazen.Mahrous@Pagora.Grenoble-inp.fr">Contacter l'administrateur</a>
            <BR><BR>      		
        </td>
    </tr>
</TABLE>
                                                          

</body></html>;






