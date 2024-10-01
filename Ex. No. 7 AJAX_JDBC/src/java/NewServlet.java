/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

/**
 *
 * @author arthe
 */
public class NewServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        String regNo=request.getParameter("reg_no");
        PrintWriter out=response.getWriter();
        
        if(regNo!=null && !regNo.isEmpty())
        {
            
            try{
              String url="jdbc:mysql://localhost:3306/student";
              String username="root";
              String password="Arthey@1274";
         
              Connection conn=null;
              PreparedStatement stmt=null;
              Class.forName("com.mysql.cj.jdbc.Driver");
              conn=DriverManager.getConnection(url,username,password);
              String sql="Select * from students where reg_no=?";
              stmt=conn.prepareStatement(sql);
              stmt.setInt(1,Integer.parseInt(regNo));
              ResultSet rs = stmt.executeQuery();
              
               if (rs.next()) {
                    out.println("<b>Registration Number:</b> " + rs.getInt("reg_no") + "<br>");
                    out.println("<b>Name:</b> " + rs.getString("name") + "<br>");
                    out.println("<b>Email:</b> " + rs.getString("email") + "<br>");
                    out.println("<b>Department:</b> " + rs.getString("dept") + "<br>");
                } else {
                    out.println("No student found for registration number: " + regNo);
                }
  
               rs.close();
                stmt.close();
                conn.close();
            }
        
        catch (Exception e) {
                out.println("Error: " + e.getMessage());
            }
        }
        
    }
          

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
