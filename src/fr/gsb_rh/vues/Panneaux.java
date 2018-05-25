package fr.gsb_rh.vues;


import java.awt.event.ActionListener;
import javax.swing.JPanel;
import javax.swing.Spring;
import javax.swing.SpringLayout;
import fr.gsb_rh.controleurs.Controlleur;

/**
 * Classe abstraite qui regroupe toutes les méthodes utilisées dans les différents panneaux
 * @see PanneauAjout.java
 * @see PanneauModifier.java
 * @author antoine & audrey
 * @version 1.0
 */
public abstract class Panneaux extends JPanel implements ActionListener {
	private static final long serialVersionUID = -733261604364482113L;
	protected Champ nom = new Champ("Nom : *"); 
	protected Champ prenom = new Champ("Prénom : *"); 
	protected Champ adresse = new Champ("Adresse : *");
	protected Champ cp = new Champ("CP : *");
	protected Champ ville = new Champ("Ville : *");
	protected Champ dateEmbauche = new Champ("Date d'embauche (JJMMAAAA) : *");
	protected Champ telephone = new Champ("Téléphone : *");
	protected Champ email = new Champ("Email : *");
	protected Champ Login; 
	protected Champ mdp; 
	protected Champ DateDepart;
	protected Controlleur controlleur = new Controlleur();
	protected ChoixEmploye listService = new ChoixEmploye("Service : *", this.controlleur.listerService());


	/**
	 * Méthode de remplissage des différents champs
	 */
	public void remplirChamp(){
		this.nom.setDansSaisie(this.controlleur.getEmployeSelectionne().getNom());
		this.prenom.setDansSaisie(this.controlleur.getEmployeSelectionne().getPrenom());
		this.adresse.setDansSaisie(this.controlleur.getEmployeSelectionne().getAdresse());
		this.cp.setDansSaisie(this.controlleur.getEmployeSelectionne().getCP());
		this.ville.setDansSaisie(this.controlleur.getEmployeSelectionne().getVille());
		this.dateEmbauche.setDansSaisie(this.controlleur.DateFR(this.controlleur.getEmployeSelectionne().getDateEmbauche()));
		this.telephone.setDansSaisie(this.controlleur.getEmployeSelectionne().getTelephone());
		this.email.setDansSaisie(this.controlleur.getEmployeSelectionne().getMail());
		this.listService.getComboBox().setSelectedIndex(this.controlleur.getEmployeSelectionne().getIdService()-1);
	}
	
	/**
	 * Méthode d'effacement des différents champs
	 */
	public void effacerChampSaisie(){
		this.nom.effacerSaisie();
		this.prenom.effacerSaisie();
		this.dateEmbauche.effacerSaisie();
		this.adresse.effacerSaisie();
		this.cp.effacerSaisie();
		this.ville.effacerSaisie();
		this.telephone.effacerSaisie();
		this.email.effacerSaisie();	
	}
	
	
	/**
	 * Méthode de verification des champs
	 * Le booléen passe à l'état vrai si tous les champs contiennent du texte 
	 * @return estRempli : boolean
	 */
	public boolean verifSaisie(){
		boolean estRempli = false;
		if(this.nom.VerifierChamps()&&this.prenom.VerifierChamps()&&this.email.VerifierChamps()&&
		   this.adresse.VerifierChamps()&&this.cp.VerifierChamps()&&this.ville.VerifierChamps()&&
		   this.dateEmbauche.VerifierChamps()&&this.telephone.VerifierChamps())
			estRempli = true;
		return estRempli;
		
	}	
	
	/**
	 * Méthode de placement des différents champs  = panneauxAjout
	 * @return content : JPanel
	 */
	public JPanel placerChamps(){
		//SpringLayout
		JPanel content = new JPanel(new SpringLayout());
		SpringLayout.Constraints champNom = new SpringLayout.Constraints();
		SpringLayout.Constraints champPrenom = new SpringLayout.Constraints();
		SpringLayout.Constraints champDateE = new SpringLayout.Constraints();
		SpringLayout.Constraints champAdr = new SpringLayout.Constraints();
		SpringLayout.Constraints champCP = new SpringLayout.Constraints();
		SpringLayout.Constraints champVille = new SpringLayout.Constraints();
		SpringLayout.Constraints champMail = new SpringLayout.Constraints();
		SpringLayout.Constraints champTel = new SpringLayout.Constraints();
		SpringLayout.Constraints champListService = new SpringLayout.Constraints();
		
		//nom
		Spring yPadding = Spring.constant(40);
		champNom.setX(Spring.constant(160));
		champNom.setY(yPadding);
		//prenom
		yPadding = Spring.constant(80);
		champPrenom.setX(Spring.constant(140));
		champPrenom.setY(yPadding);
	    //Telephone
	    yPadding = Spring.constant(120);
	    champTel.setX(Spring.constant(127));
	    champTel.setY(yPadding);
	    //Date embauche
	    yPadding = Spring.constant(160);
	    champDateE.setX(Spring.constant(10));
	    champDateE.setY(yPadding);
		//Adresse
	    yPadding = Spring.constant(40);
	    champAdr.setX(Spring.constant(500));
	    champAdr.setY(yPadding);
	    //CP
	    yPadding = Spring.constant(80);
	    champCP.setX(Spring.constant(532));
	    champCP.setY(yPadding);
	    //Ville
	    yPadding = Spring.constant(120);
	    champVille.setX(Spring.constant(525));
	    champVille.setY(yPadding);
	    //Mail
	    yPadding = Spring.constant(160);
	    champMail.setX(Spring.constant(520));
	    champMail.setY(yPadding);
	    //Service
	    yPadding = Spring.constant(200);
		champListService.setX(Spring.constant(505));
		champListService.setY(yPadding);
	    //Add au panel principal
		content.add(this.nom,champNom);
		content.add(this.prenom,champPrenom);	
		content.add(this.dateEmbauche,champDateE);
		content.add(this.adresse,champAdr);
		content.add(this.cp,champCP);	
		content.add(this.ville,champVille);
		content.add(this.email,champMail);
		content.add(this.telephone,champTel);
		content.add(this.listService,champListService);
		return content;
	}
	
	/**
	 * Méthode de placement des différents champs = panneauxModifier
	 * @return content : JPanel
	 */
	public JPanel placerChamps(boolean flag){
		//SpringLayout
		this.DateDepart = new Champ("Date de départ(JJMMAAAA) : *");
		JPanel content = new JPanel(new SpringLayout());
		SpringLayout.Constraints champNom = new SpringLayout.Constraints();
		SpringLayout.Constraints champPrenom = new SpringLayout.Constraints();
		SpringLayout.Constraints champDateE = new SpringLayout.Constraints();
		SpringLayout.Constraints champAdr = new SpringLayout.Constraints();
		SpringLayout.Constraints champCP = new SpringLayout.Constraints();
		SpringLayout.Constraints champVille = new SpringLayout.Constraints();
		SpringLayout.Constraints champMail = new SpringLayout.Constraints();
		SpringLayout.Constraints champTel = new SpringLayout.Constraints();
		SpringLayout.Constraints champDateD = new SpringLayout.Constraints();
		SpringLayout.Constraints champListService = new SpringLayout.Constraints();
		
		//nom
		Spring yPadding = Spring.constant(40);
		champNom.setX(Spring.constant(160));
		champNom.setY(yPadding);
		//prenom
		yPadding = Spring.constant(80);
		champPrenom.setX(Spring.constant(140));
		champPrenom.setY(yPadding);
	    //Telephone
	    yPadding = Spring.constant(120);
	    champTel.setX(Spring.constant(127));
	    champTel.setY(yPadding);
	    //Date embauche
	    yPadding = Spring.constant(160);
	    champDateE.setX(Spring.constant(10));
	    champDateE.setY(yPadding);
	    //Date de départ
	    yPadding = Spring.constant(200);
	    champDateD.setX(Spring.constant(30));
	    champDateD.setY(yPadding);
		//Adresse
	    yPadding = Spring.constant(40);
	    champAdr.setX(Spring.constant(500));
	    champAdr.setY(yPadding);
	    //CP
	    yPadding = Spring.constant(80);
	    champCP.setX(Spring.constant(532));
	    champCP.setY(yPadding);
	    //Ville
	    yPadding = Spring.constant(120);
	    champVille.setX(Spring.constant(525));
	    champVille.setY(yPadding);
	    //Mail
	    yPadding = Spring.constant(160);
	    champMail.setX(Spring.constant(520));
	    champMail.setY(yPadding);
	    //Service
	    yPadding = Spring.constant(200);
		champListService.setX(Spring.constant(505));
		champListService.setY(yPadding);
	    //Add au panel principal
		content.add(this.nom,champNom);
		content.add(this.prenom,champPrenom);	
		content.add(this.dateEmbauche,champDateE);
		content.add(this.adresse,champAdr);
		content.add(this.cp,champCP);	
		content.add(this.ville,champVille);
		content.add(this.email,champMail);
		content.add(this.telephone,champTel);
		content.add(this.DateDepart,champDateD);
		content.add(this.listService,champListService);
		return content;
	}
}
