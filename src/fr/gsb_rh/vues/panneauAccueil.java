package fr.gsb_rh.vues;
import java.awt.event.ActionEvent;

import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.SpringLayout;

/**
 * Classe graphique d'affichage du panel d'accueil
 * @author antoine & audrey
 * @see Panneaux.java
 * @version 1.0
 */
public class panneauAccueil extends Panneaux {
	private static final long serialVersionUID = 1L;
	
	/**
	 * Constructeur par défaut
	 */
	public panneauAccueil(){
		super();
//		this.initComponents();
		
	}
	
	/**
	 * Méthode d'initialisation des éléments de la fenetre
	 */
	public void initComponents(){
		this.controlleur.getLeRhConnecte().getId();
		JLabel nomRh = new JLabel();
		JLabel prenomRh = new JLabel();
		JLabel idRh = new JLabel();
		SpringLayout springLayout = new SpringLayout();
		JPanel panelInfo = new JPanel(springLayout);
		panelInfo.add(nomRh);
		panelInfo.add(prenomRh);
		panelInfo.add(idRh);
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		
	}
}
