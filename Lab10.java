import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Random;

import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;

import net.sourceforge.barbecue.Barcode;
import net.sourceforge.barbecue.BarcodeException;
import net.sourceforge.barbecue.BarcodeFactory;

public class Lab10 {

	public static void main(String[] args) throws Exception {
		
		JFrame s = new JFrame("Barcode Generator");
		
		JTextField tf = new JTextField("            ");
		JCheckBox cb1 = new JCheckBox("Code 128");
		JCheckBox cb2 = new JCheckBox("Code 39");
		JCheckBox cb3 = new JCheckBox("Codebar");
		JButton b1 = new JButton("Generate");

		Container c= s.getContentPane();
		c.setLayout(new FlowLayout());
		c.add(tf);
		c.add(cb1);
		c.add(cb2);
		c.add(cb3);
		c.add(b1);

		
		s.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		s.pack();
		s.setVisible(true);
	
	    try {
			Barcode barcode = BarcodeFactory.createCode128B("be the coder");
		} catch (BarcodeException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}



		
	}

}
