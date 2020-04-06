// A Java program for a Client

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.Socket;
import java.net.UnknownHostException;

public class Client
{
    // initialize socket and input output streams
    private Socket socket		 = null;
    private DataInputStream input = null;
    private DataOutputStream out	 = null;

    // constructor to put ip address and port
    public Client(String address, int port)
    {
        // establish a connection
        try
        {
            socket = new Socket(address, port);
            System.out.println("Connected");

            // takes input from terminal
            input = new DataInputStream(System.in);

            // sends output to the socket
            out = new DataOutputStream(socket.getOutputStream());
        }
        catch(UnknownHostException u)
        {
            System.out.println(u);
        }
        catch(IOException i)
        {
            System.out.println(i);
        }


        JFrame frame = new JFrame("Vatera");
        frame.setBounds(200, 200, 450, 500);

        JLabel label1 = new JLabel("Bejelentkezés");
        label1.setBounds(10, 5, 100, 25);

        JTextField tField1 = new JTextField("Felhasználónév");
        tField1.setBounds(90, 350, 230, 25);

        JButton button3 = new JButton("Bejelentkezés");
        button3.setBounds(340, 350, 80, 25);

        button3.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String field;
                field = tField1.getText();
                try {
                    out.writeUTF(field);
                } catch (IOException ex) {
                    ex.printStackTrace();
                }
            }
        });

        frame.setLayout(null);
        frame.add(label1);
        frame.add(tField1);
        frame.add(button3);
        frame.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
        frame.setVisible(true);


        // string to read message from input
        String line = "";

        // keep reading until "Over" is input
        while (!line.equals("Over"))
        {
            try
            {
                line = input.readLine();
                out.writeUTF(line);
            }
            catch(IOException i)
            {
                System.out.println(i);
            }
        }

        // close the connection
        try
        {
            input.close();
            out.close();
            socket.close();
        }
        catch(IOException i)
        {
            System.out.println(i);
        }
    }

    public static void main(String args[])
    {
        Client client = new Client("127.0.0.1", 5000);
    }
}
