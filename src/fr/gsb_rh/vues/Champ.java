package fr.gsb_rh.vues;
import java.awt.Dimension;

import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

public class Champ extends JPanel{
	private static final long serialVersionUID = -10933747520345322L;
	private JLabel label;
	private JTextField saisie;
	private JPasswordField saisieMdp;
//////////////////CONSTRUCTEURS////////////////////////////
	
	/**
	 * Constructeur par défaut
	 */
	public Champ(){}
	
	/**
	 * Constructeur surchargé afin d'ajouté un nom devant le champ de saisie
	 * @param label : String
	 */
	public Champ(String label){
		this.label = new JLabel(label);
		this.saisie = new JTextField();
		this.saisie.setPreferredSize(new Dimension(150,30));	
		this.add(this.label);
		this.add(this.saisie);		
	}
	
	
	/**
	 * Constructeur d'un champ de saisie de mot de passe
	 * @param label : String
	 * @param parametreOption : String
	 */
	public Champ(String label,String parametreOption){
		this.label = new JLabel(label);
		this.saisieMdp = new JPasswordField();
		this.saisieMdp.setPreferredSize(new Dimension(150,30));	
		this.add(this.label);
		this.add(this.saisieMdp);		
	}
	
///////////////////////GETTERS & SETTERS///////////////////

	/**
	 * Méthode qui injecte une chaine de caractères dans le champ de saisie
	 * @param conetnu : String
	 */
	public void setDansSaisie(String contenu){
		this.saisie.setText(contenu);
	}

	/**
	 * Méthode qui retourne le contenu d'un champ de saisie
	 * @return this.saisie.getText() : String
	 */
	public String getDansSaisie(){
		return this.saisie.getText();
	}
	
	/**
	 * Methode qui retourne le contenu d'un champ de saisie de mot de passe
	 * @return mdp : String
	 */
	public String getDansMdp(){
		char[] leMdp = this.saisieMdp.getPassword();
		String mdp = new String(leMdp);
		return mdp;
	}
	
///////////////////////METHODES DE CLASSE////////////////////////////////
	
	/**
	 * Methode qui efface le contenu d'un champ de saisie
	 */
	public void effacerSaisie(){
		this.saisie.setText("");
	}
	
	/**
	 * Vérifie le contenu d'un champ de saisie.
	 * Retourne vrai si le champ est vide
	 * @return estVide : boolean
	 */
	public Boolean VerifierChamps(){
		boolean flag=false;
		if(this.getDansSaisie().toString().equals(""))
			flag=true;
		 return flag;
	}
	
}
