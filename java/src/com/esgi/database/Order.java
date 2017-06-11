package com.esgi.database;

public class Order {

    private Long id;
    private Double invoice;
    private String startDate;
    private String endDate;

    public Order(Long id,
                 Double invoice,
                 String startDate,
                 String endDate) {
        this.id = id;
        this.invoice = invoice;
        this.startDate = startDate;
        this.endDate = endDate;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Double getInvoice() {
        return invoice;
    }

    public void setInvoice(Double invoice) {
        this.invoice = invoice;
    }

    public String getStartDate() {
        return startDate;
    }

    public void setStartDate(String startDate) {
        this.startDate = startDate;
    }

    public String getEndDate() {
        return endDate;
    }

    public void setEndDate(String endDate) {
        this.endDate = endDate;
    }

    @Override
    public String toString() {
        return "Order{" +
                "id=" + id +
                ", invoice=" + invoice +
                ", startDate='" + startDate + '\'' +
                ", endDate='" + endDate + '\'' +
                '}';
    }
}
