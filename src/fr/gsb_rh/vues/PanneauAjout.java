package fr.gsb_rh.vues;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionEvent;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

/**
 * Classe graphique d'affichage du panel d'ajout d'utilisateur
 * @see Panneaux.java
 * @author antoine & audrey
 * @version 1.0
 */
public class PanneauAjout extends Panneaux {
	private static final long serialVersionUID = -7224798746581420809L;	
	public PanneauAjout(){
		super();
		this.initComponents();
	}
	
	public void initComponents(){
		
		//Panels et Layout
		JPanel table = new JPanel();
		JPanel content = this.placerChamps();
		JPanel boutons = new JPanel();
		JLabel titre = new JLabel("Pour ajouter un nouvel employé, il faut renseigner l'ensemble des champs ci-dessous");
		JButton annuler = new JButton("Annuler");
		JButton valider = new JButton("Valider");

		titre.setForeground(Color.white);
		table.setBackground(new Color(70,80,70));
		table.setPreferredSize(new Dimension(100,70));
		valider.addActionListener(this);
		annuler.addActionListener(this);
		this.setLayout(new BorderLayout());
		this.add(table, BorderLayout.NORTH);
		this.add(content, BorderLayout.CENTER);
		this.add(boutons, BorderLayout.SOUTH);
		boutons.add(valider);
		boutons.add(annuler);
		table.add(titre);
		
	}
	
	public void actionPerformed(ActionEvent e) {
		String action = e.getActionCommand();	
		 //Permet de remettre les renseigenements de bases sur l'employé si l'utilisateur appuie sur "annuler"
		if(action.equals("Annuler")){
			this.remplirChamp();
		}
		//Si l'utilisateur clic que "Valider", alors on enregistre les données en base. 
		if(action.equals("Valider")){
			this.controlleur.getEmployeSelectionne().setNom(this.nom.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setPrenom(this.prenom.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setAdresse(this.adresse.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setCP(this.cp.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setVille(this.ville.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setTelephone(this.telephone.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setMail(this.email.getDansSaisie());
			this.controlleur.getEmployeSelectionne().setIdService(this.listService.getComboBox().getSelectedIndex()+1);
			this.controlleur.majEmploye(this.controlleur.getEmployeSelectionne());
			JOptionPane.showMessageDialog(null,"Modification effectuée","Valider",JOptionPane.ERROR_MESSAGE);
			this.listService.majList(this.controlleur.getLesEmployes());
		}
	}
}
