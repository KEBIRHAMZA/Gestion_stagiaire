from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name="index"),
    path('create/', views.create_stagiaire, name='create_stagiaire'),
    path('update/<str:nom>/', views.update_stagiaire, name='update_stagiaire'),
    path('delete/<str:nom>/', views.delete_stagiaire, name='delete_stagiaire'),
    path('generate_pdf/', views.generate_pdf, name='generate_pdf'),
]