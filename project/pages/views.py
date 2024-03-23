from django.shortcuts import render, redirect
from .models import stagiaire_collection
from reportlab.lib import colors
from reportlab.lib.pagesizes import letter
from reportlab.platypus import SimpleDocTemplate, Table, TableStyle
import io
from django.http import FileResponse
from reportlab.pdfgen import canvas

def generate_pdf_bytes(st):
    buffer = io.BytesIO()
    doc = SimpleDocTemplate(buffer, pagesize=letter)
    
    data = [['Nom complet', 'Controle 1', 'Controle 2', 'Controle 3','Moyenne']]

    for s in st:
        note1 = float(s['note1'])
        note2 = float(s['note2'])
        note3 = float(s['note3'])
        avg_note = (note1 + note2 + note3) / 3
        s['avg_note'] = "{:.2f}".format(avg_note)
        data.append([s['nom'] + ' ' + s['prenom'], str(s['note1']), str(s['note2']), str(s['note3']), str(s['avg_note'])])

    style = [
        ('GRID', (0, 0), (-1, -1), 1, colors.black),
        ('BACKGROUND', (0, 0), (-1, 0), colors.blue),  
        ('TEXTCOLOR', (0, 0), (-1, 0), colors.white),  
        ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),  
        ('ALIGN', (0, 0), (-1, -1), 'CENTER'),  
        ('VALIGN', (0, 0), (-1, -1), 'MIDDLE'),  
    ]

    table = Table(data)
    table.setStyle(TableStyle(style))

    elements = [table]
    doc.build(elements)

    buffer.seek(0)
    return buffer

def generate_pdf(request):
    query = request.GET.get('query')
    st = list(stagiaire_collection.find())

    if query:
        st = [s for s in st if query.lower() in f"{s['nom'].lower()} {s['prenom'].lower()}"]

    buffer = generate_pdf_bytes(st)

    response = FileResponse(buffer, as_attachment=True, filename="table.pdf")
    return response


def index(request):
    query = request.GET.get('query')
    sort_order = request.GET.get('sort', 'asc')  

    st = list(stagiaire_collection.find())
    total_stagiaires = len(st)

    if query:
        st = [s for s in st if query.lower() in f"{s['nom'].lower()} {s['prenom'].lower()}"]

    for s in st:
        s['id_str'] = str(s['_id'])
        note1 = float(s['note1'])
        note2 = float(s['note2'])
        note3 = float(s['note3'])
        s['avg_note'] = "{:.2f}".format((note1 + note2 + note3) / 3)
        if float(s['avg_note']) >= 10:
            s['mention'] = "Admis"
        else:
            s['mention'] = "Redoublant"

    st.sort(key=lambda s: float(s['avg_note']), reverse=(sort_order == 'desc'))

    total_redoublants = sum(1 for s in st if float(s['avg_note']) < 10)
    total_admis = sum(1 for s in st if float(s['avg_note']) >= 10)
    percentage_admis = "{:.2f}".format((total_admis / total_stagiaires) * 100 if total_stagiaires > 0 else 0)

    return render(request, 'pages/index.html', {"st": st, "total_stagiaires": total_stagiaires, "total_redoublants": total_redoublants, "total_admis": total_admis, "percentage_admis": percentage_admis})

def create_stagiaire(request):
    if request.method == 'POST':
        nom = request.POST.get('nom')
        prenom = request.POST.get('prenom')
        note1 = request.POST.get('note1')
        note2 = request.POST.get('note2')
        note3 = request.POST.get('note3')
        
        stagiaire_collection.insert_one({
            "nom": nom,
            "prenom": prenom,
            "note1": note1,
            "note2": note2,
            "note3": note3
        })
        return redirect('index')
    return render(request, 'pages/create.html')

def update_stagiaire(request, nom):
    if request.method == 'POST':
        nom = request.POST.get('nom')
        prenom = request.POST.get('prenom')
        note1 = request.POST.get('note1')
        note2 = request.POST.get('note2')
        note3 = request.POST.get('note3')
        
        stagiaire_collection.update_one(
            {"nom": nom},  
            {"$set": {
                "prenom": prenom,
                "note1": note1,
                "note2": note2,
                "note3": note3
            }}
        )
        return redirect('index')
    else:
        stagiaire = stagiaire_collection.find_one({"nom": nom})
        return render(request, 'pages/update.html', {'stagiaire': stagiaire})

def delete_stagiaire(request, nom):
    if request.method == 'POST':
        stagiaire_collection.delete_one({"nom": nom})  
        return redirect('index')
    return render(request, 'pages/delete.html')
