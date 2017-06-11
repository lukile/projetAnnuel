package com.esgi.database;

public class User {
    private String firstname;
    private String lastname;
    private String mail;

    private Order order;

    public User(String firstname,
                String lastname,
                String mail,
                Order order) {
        this.firstname = firstname;
        this.lastname = lastname;
        this.mail = mail;
        this.order = order;
    }

    public String getFirstname() {
        return firstname;
    }

    public void setFirstname(String firstname) {
        this.firstname = firstname;
    }

    public String getLastname() {
        return lastname;
    }

    public void setLastname(String lastname) {
        this.lastname = lastname;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public Order getOrder() {
        return order;
    }

    public void setOrder(Order order) {
        this.order = order;
    }

    @Override
    public String toString() {
        return "User{" +
                "firstname='" + firstname + '\'' +
                ", lastname='" + lastname + '\'' +
                ", mail='" + mail + '\'' +
                ", order=" + order +
                '}';
    }
}
