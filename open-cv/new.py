import matplotlib.pyplot as plt
import matplotlib.patches as mpatches
from matplotlib.patches import FancyBboxPatch
from matplotlib.patches import FancyArrowPatch

# Create a new figure
fig, ax = plt.subplots(figsize=(12, 8))
ax.set_xlim(0, 10)
ax.set_ylim(0, 12)

# Function to create rectangles for steps
def create_step(ax, x, y, text):
    rect = FancyBboxPatch((x, y), 4, 1, boxstyle="round,pad=0.3", edgecolor="black", facecolor="lightblue")
    ax.add_patch(rect)
    ax.text(x + 2, y + 0.5, text, ha="center", va="center", fontsize=10)

# Function to create arrows between steps
def create_arrow(ax, x, y, dx, dy):
    arrow = FancyArrowPatch((x, y), (x + dx, y + dy), arrowstyle='->', mutation_scale=15, color="black", linewidth=1.5)
    ax.add_patch(arrow)

# Draw steps
create_step(ax, 3, 10, "Satellite Image Capture")
create_step(ax, 3, 8, "Data Processing for Heatmaps")
create_step(ax, 3, 6, "Heatmap Analysis for Hotspots")
create_step(ax, 3, 4, "Drone Deployment")
create_step(ax, 3, 2, "Change Detection and Analysis")
create_step(ax, 3, 0, "Alert Generation")

# Draw final steps on the right
create_step(ax, 7, 4, "Data Visualization on Dashboard")
create_step(ax, 7, 2, "Generation of Reports")
create_step(ax, 7, 0, "Feedback Loop for Improvement")

# Draw arrows
create_arrow(ax, 5, 10.5, 0, -1.5)  # Satellite Image Capture -> Data Processing for Heatmaps
create_arrow(ax, 5, 8.5, 0, -1.5)   # Data Processing for Heatmaps -> Heatmap Analysis for Hotspots
create_arrow(ax, 5, 6.5, 0, -1.5)   # Heatmap Analysis for Hotspots -> Drone Deployment
create_arrow(ax, 5, 4.5, 0, -1.5)   # Drone Deployment -> Change Detection and Analysis
create_arrow(ax, 5, 2.5, 0, -1.5)   # Change Detection and Analysis -> Alert Generation
create_arrow(ax, 5, 0.5, 2, 0)      # Alert Generation -> Data Visualization on Dashboard
create_arrow(ax, 9, 3.5, 0, -1.5)   # Data Visualization on Dashboard -> Generation of Reports
create_arrow(ax, 9, 1.5, 0, -1.5)   # Generation of Reports -> Feedback Loop for Improvement

# Set plot properties
ax.axis("off")
ax.set_title("Flow Chart of ISUSS Workflow", fontsize=14)

plt.show()
