package fr.gsb_rh.controleurs;

import fr.gsb_rh.modeles.Employe;
import fr.gsb_rh.modeles.RequeteBase;
import fr.gsb_rh.vues.FenetreAppli;
import fr.gsb_rh.vues.Login;
import fr.gsb_rh.vues.PanneauAjout;
import fr.gsb_rh.vues.PanneauModifier;
import java.util.ArrayList;
import javax.swing.JPanel;

/**
 * Controlleur de l'application GSB_RH. 
 * C'est cette classe qui fait le lien entre les modèles et les vues de l'application.
 * @author antoine & audrey
 * @version 1.0
 */
public class Controlleur {
	private Employe leRhConnecte = null;
	private ArrayList<Employe> lesEmployes;
	private Employe employeSelectionne;
	
	/** Constructeur vide */
	public Controlleur(){
		
	}
	
/////////////////////AFFICHAGE//////////////////////////
	
	/**
	 * Méthode d'affichage de la fenetre de connexion.
	 */
	public void demanderLogin(){
		Login Login = new Login(this);
		Login.setVisible(true);
	}
	
	
	/**
	 * Méthode d'affichage de la fenetre principale
	 */
	public void lancerAppli(){
		FenetreAppli appliRH = new FenetreAppli();
		appliRH.AjoutOnglets(this.listerLibelles(), this.listerPanels());
		appliRH.setVisible(true);
	}
	

	/**
	 * Méthode d'ajout des différents panels de l'application
	 * @return panels : JPanel[]
	 */
	private JPanel[] listerPanels(){
		JPanel panels[] = {new JPanel(),new PanneauAjout(), new PanneauModifier(RequeteBase.getTousLesUsersEnFonction())};
		return panels;
	}

	
	/**
	 * Methode qui retourne les nom des onglets de l'application
	 * @return libelles : String[]
	 */
	private String[] listerLibelles(){
		String libelles[] = {"Accueil","Ajouter un utilisateur","Modifier un utilisateur"};
		return libelles;
	}
	
/////////////////////GETTERS & SETTERS////////////////////////
	/**
	 * Getter de la variable de classe employeSelectionne
	 * @return unEmploye : Employe
	 */
	public Employe getEmployeSelectionne() {
		return employeSelectionne;
	}
	
	/**
	 * Setter de la variable de classe employeSelectionne
	 * @param employeSelectionne : Employe
	 */
	public void setEmployeSelectionne(Employe employeSelectionne) {
		this.employeSelectionne = employeSelectionne;
	}
	
	/**
	 * Getter de la variable de classe leRhConnecte
	 * @return leRhConnecte : Employe
	 */
	public Employe getLeRhConnecte() {
		return leRhConnecte;
	}
	
	/**
	 * Setter de la variable de classe leRhConnecte
	 * @param leRhConnecte : Employe
	 */
	public void setLeRhConnecte(Employe leRhConnecte) {
		this.leRhConnecte = leRhConnecte;
	}
	
	/**
	 * Getter de la variable de classe lesEmployes
	 * @return lesEmployes : ArrayList<Employe>
	 */
	public ArrayList<Employe> getLesEmployes() {
		lesEmployes = RequeteBase.getTousLesUsers();
		return lesEmployes;
	}

	/**
	 * Setter de la variable de classe lesEmployes
	 * @param lesEmployes : ArrayList<Employe>
	 */
	public void setLesEmployes(ArrayList<Employe> lesEmployes) {
		this.lesEmployes = lesEmployes;
	}	
	
/////////////////////METHODES DE CLASSE//////////////////////////
	
	/**
	 * Méthode de récupération des informations utilisateur grâce à son login
	 * @param login : String
	 * @return employeConnecte : Employe
	 */
	public Employe getEmployeConnecte(String login){
		return RequeteBase.getEmployeConnecte(login);
	}
	
	
	/**
	 * Méthode de test du mot de passe et du login d'un utilisateur.
	 * Le booléen passe à vrai si les logs concordent.
	 * @param log : String
	 * @param mdp : String
	 * @return estConnecte : Boolean
	 */
	public boolean verifierMdp(String log, String mdp){
		return RequeteBase.estConnecte(log, mdp);
	}
	
	/**
	 * Méthode de test des droits de l'utilisateur
	 * Le booléen passe à vrai si il est RH (id_service = 3).
	 * @param log : String 
	 * @param mdp : String 
	 * @return aLeDroit : Boolean
	 */
	public boolean verifierDroits(String log, String mdp){
		return RequeteBase.verifDroits(log, mdp);
	}
	
	/**
	 * Méthode qui créée un employé dans la base de données
	 * @param employe : Employe
	 */
	public void ajouterEmploye(Employe employe){
		RequeteBase.AjoutEmploye(employe);
	}
	
	/**
	 * Méthode qui retourne un objet Employe grâce à son nom et prénom
	 * @param nom : String
	 * @param prenom : String
	 * @return unEmploye : Employe
	 */
	public Employe unEmploye(String nom, String prenom){
		return RequeteBase.unEmploye(nom,prenom);
	}
	
	/**
	 * Méthode qui récupère le nom des services de GSB
	 * @return lesServices : String[]
	 */
	public String[] listerService(){
		return RequeteBase.getLesServices();
	}
	
	/**
	 * Methode qui modifie les informations d'un employé 
	 * @param employe : Employe
	 */
	public void majEmploye(Employe employe){
		RequeteBase.modifierEmploye(employe);
	}
	
	/**
	 * Méthode de création d'un employe
	 * @param nom : String
	 * @param prenom : String
	 * @param dateNaissance : String
	 * @param adresse : String
	 * @param cp : String
	 * @param ville : String
	 * @param telephone : String
	 * @param mail : String
	 * @param dateEmbauche  : String
	 * @param idService : String
	 */
	public void creerEmploye(String nom, String prenom, String adresse, String cp, String ville, String telephone,String mail, String dateEmbauche, int idService){
		Employe unEmploye = new Employe(nom,prenom,adresse,cp,ville,telephone,mail,dateEmbauche,idService);
		RequeteBase.AjoutEmploye(unEmploye);
	}
	
	
	/**
	 * Methode pour formater la date au format de MySQL
	 * @param date : String : date au format jjmmaaaa
	 * @return date : String : date au format aaaa-mm-jj
	 */
	public String formatterDate(String date){
		String modifDate = date.substring(4,8)+"-"+date.substring(2,4)+"-"+date.substring(0,2);
		return modifDate;
	}
	
	/**
	 * Methode pour formater la date au format français.
	 * @param date : String : date au format jjmmaaaa
	 * @return date : String : date au format aaaa-mm-jj
	 */
	public String DateFR (String date){
		String modifDate = date.substring(8,10)+ date.substring(5,7) + date.substring(0,4);
		return modifDate;
	}
	
}
