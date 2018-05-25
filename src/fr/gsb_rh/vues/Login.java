package fr.gsb_rh.vues;



import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.Spring;
import javax.swing.SpringLayout;

import fr.gsb_rh.controleurs.Controlleur;

/**
 * Classe graphique d'affichage de l'écran de connexion
 * @author antoine & audrey
 * @see Controlleur.java
 * @version 1.0
 */
public class Login extends JFrame implements ActionListener{
	private static final long serialVersionUID = 8353606416367742496L;
	protected Controlleur controleur;
	protected Champ saisieLogin;
	protected Champ saisieMdp;
	protected JButton boutonValider;
	
	/**
	 * Constructeur surchargé qui prend en paramètre un objet Controlleur 
	 * @param controleur : Controlleur
	 */
	public Login(Controlleur controleur){
		super();
		this.controleur = controleur;
		this.initComponents();
		this.setExtendedState(JFrame.MAXIMIZED_BOTH);
		setTitle("Application GSB_RH");
		// Centrer la fenêtre.
	    //Pour une autre position : this.setLocation(x,y);
	    this.setLocationRelativeTo(null);
		setSize(300,250);
		setResizable(false);
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
	}
	
	/**
	 * Méthode d'initialisation des éléments de la fenêtre
	 */
	public void initComponents(){
		//Instance du panneau et du layout
		JPanel panelLogin = new JPanel();
		SpringLayout springLayout = new SpringLayout();
		panelLogin.setLayout(springLayout);
		//Instances des objets du paneau
		saisieLogin = new Champ("Login : ");
		saisieMdp = new Champ("Mot de passe : ","");
		boutonValider = new JButton("Valider");
		boutonValider.addActionListener(this);
		//Définition des contraintes SpringLayout
		SpringLayout.Constraints champLogin = new SpringLayout.Constraints();
		SpringLayout.Constraints champMdp = new SpringLayout.Constraints();
		SpringLayout.Constraints bouton = new SpringLayout.Constraints();
		//Position du champLogin
		Spring yPadding = Spring.constant(40);
		champLogin.setX(Spring.constant(55));
		champLogin.setY(yPadding);
		//Position du champMdp
		yPadding = Spring.constant(70);
		champMdp.setX(Spring.constant(10));
		champMdp.setY(yPadding);
	    //Position du bouton
	    yPadding = Spring.constant(120);
	    bouton.setX(Spring.constant(110));
	    bouton.setY(yPadding);
	    //Ajout au panel
		panelLogin.add(saisieLogin,champLogin);
		panelLogin.add(saisieMdp,champMdp);
		panelLogin.add(boutonValider,bouton);
		//Ajout du panel à la fenetre
		this.add(panelLogin);
	}

	/**
	 * Méthode d'écoute du bouton valider
	 */
	public void actionPerformed(ActionEvent arg0) {
		// TODO Auto-generated method stub
		if(this.controleur.verifierMdp(this.saisieLogin.getDansSaisie(),this.saisieMdp.getDansMdp())){
			if(this.controleur.verifierDroits(this.saisieLogin.getDansSaisie(),this.saisieMdp.getDansMdp())){
				this.controleur.setLeRhConnecte(this.controleur.getEmployeConnecte(this.saisieLogin.getDansSaisie()));
				this.controleur.lancerAppli();
				this.dispose();
			}else JOptionPane.showMessageDialog(null,"Vous n'avez pas les droits requis pour accéder à cette application","Valider",JOptionPane.ERROR_MESSAGE);
			
		}else JOptionPane.showMessageDialog(null,"Login et/ou mot de passe erroné","Valider",JOptionPane.ERROR_MESSAGE);				
	}
}
